import { User } from '../../src/js/user.module.js?v=2.1.7'   

const ReferralsViewer = {
    name : 'referrals-viewer',
    data() {
        return {
            User: new User,
            referralsAux: null,
            query: null,
            referrals: null,
            totals: {
                total_capital: 0
            },
        }
    },
    watch: {
        query: {
            handler() {
                this.filterData()
            },
            deep: true
        },
    },
    methods: {
        filterData() {
            this.referrals = this.referralsAux
            this.referrals = this.referrals.filter((referral) => {
                return referral.names.toLowerCase().includes(this.query.toLowerCase()) 
            })
        },
        sendWhatsapp(name,whatsapp,phone_code) {
            whatsapp = phone_code + whatsapp
            window.open(whatsapp.sendWhatsApp(`*Hola ${name}*, te recuerdo que está próxima a vencer tu licencia en *MoneyTv*. *Renuévala* cuanto antes para que *no pierdas* tus *beneficios*`))
        },
        getReferrals() {
            return new Promise((resolve,reject) => {
                this.User.getReferrals({}, (response) => {
                    if (response.s == 1) {
                        resolve(response.referrals)
                    }

                    reject()
                })
            })
        }
    },
    mounted() {
        this.getReferrals().then((referrals)=>{
            this.referrals = referrals
            this.referralsAux = referrals
        }).catch((error) => {this.referrals = false})
    },
    template : `
        <div
            v-if="referralsAux"
            class="card mb-4 overflow-hidden">
            <div class="card-header bg-light">
                <div class="row align-items-center">
                    <div class="col fw-semibold text-dark">Lista de referidos</div>
                    <div class="col-auto"><span class="badge text-dark">Total {{referrals.length}}</span></div>
                </div>
            </div>
        
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <input type="search" class="form-control" v-model="query" placeholder="buscar por nombre o estado"/>
                    </div>
                    <div class="col-auto">
                        <select class="form-select" v-model="status" aria-label="Filtro">
                            <option v-bind:value="null">Todas</option>
                            <option v-for="_STATUS in STATUS" v-bind:value="_STATUS.code">
                                {{ _STATUS.text }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table table-striped table-borderless align-items-center mb-0">
                        <thead>
                            <tr class="font-bold text-center text-dark text-secondary text-uppercase opacity-7">
                                <th>ID</th>
                                <th>Usuario</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>País</th>
                                <th>Estatus</th>
                                <th>Miembro desde</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="referral in referrals">
                                <td class="align-middle text-center">
                                    {{referral.company_id}}
                                </td>
                                <td class="text-center fw-semibold">
                                    <h6 class="">{{referral.names}}</h6>
                                </td>
                                <td class="text-center">
                                    <p class="text-secondary mb-0">{{referral.email}}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-secondary mb-0">{{referral.phone}}</p>
                                </td>
                                <td class="text-center">
                                    <img v-if="referral.country" :src="referral.country_id.getCoutryImage()" style="width:16px"/>
                                    {{referral.country}}
                                </td>
                                
                                <td class="text-center">
                                    <div v-if="referral.active">
                                        <span class="badge bg-success">Activo</span>
                                    </div>
                                    <div v-else>
                                        <span v-else class="badge bg-secondary">
                                            Inactivo
                                        </span>
                                        <div class="mt-3">
                                            <button @click="sendWhatsapp(referral.names,referral.phone,referral.phone_code)" class="btn btn-sm shadow-none mb-0 btn-success">Enviar WhatsApp</button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-secondary mb-0">{{referral.signup_date.formatFullDate()}}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                <div class="row align-items-center">
                    <div class="col-auto"><span class="badge bg-secondary">Cantidad de referidos {{referrals.length}}</span></div>
                </div>
            </div>
        </div>
        <div v-else-if="referrals == false">
            <div class="alert alert-light text-center">
                <div>Comienza a hacer crecer tu lista de referidos</div>
                <div class="fw-semibold fs-5">Puedes encontrar tu Link personalizado en tu <a class="text-white" href="../../apps/backoffice"><u>oficina virtual</u></a></div>
            </div>
        </div>
    `,
}

export { ReferralsViewer } 