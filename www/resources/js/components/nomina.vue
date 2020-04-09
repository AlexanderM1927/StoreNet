<template>
  <div>
    <h1 class="titulo-seccion">Mi nomina</h1>
    <center>
        <table>
            <tr>
                <td>Desde:</td>
                <td>Hasta:</td>
            </tr>
            <tr>
                <td>
                <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                <v-date-picker :mode="mode" :popover="visibility" v-model="selectedDate" color="blue" is-dark/>
                </div>
                </td>
                <td>
                <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                <v-date-picker :mode="mode1" :popover="visibility1" v-model="selectedDate1" color="blue" is-dark/>
                </div>
                </td>
            </tr>
            <tr>
                <td colspan="3"><center><button class="uk-button uk-button-primary" @click="filtrar()">Filtrar</button></center></td>
            </tr>
        </table>
    </center>
    <hr>
    <table class="uk-table uk-table-small uk-table-divider">
        <thead>
            <tr>
                <th><b>ID</b></th>
                <th>fecha</th>
                <th>dias</th>
                <th>horas extras</th>
                <th>horas nocturnas</th>
                <th>horas dom y fest</th>
                <th>deducciones</th>
                <th>total devengado</th>
                <th>total deducciones</th>
                <th>total pago</th>
            </tr>
        </thead>
        <tbody v-for="nomina in nominas">
            <tr>
                <td>{{nomina['id']}}</td>
                <td>{{nomina['fecha']}}</td>
                <td>{{nomina['dias']}}</td>
                <td>{{nomina['horasextras']}}</td>
                <td>{{nomina['recargonocturno']}}</td>
                <td>{{nomina['horasdyf']}}</td>
                <td>{{nomina['deducciones']}}</td>
                <td>{{nomina['totaldevengado']}}</td>
                <td>{{nomina['totaldeducido']}}</td>
                <td>{{nomina['totalpago']}}</td>
            </tr>
        </tbody>
    </table>
  </div>
</template>

<script>
import $ from 'jquery'
import swal from 'sweetalert'
import DatePicker from 'v-calendar/lib/components/date-picker.umd'

export default {
    name: 'nomina',
    data() {
        return{
            activo: 0,
            mode: 'single',
            selectedDate: null,
            visibility: {
            visibility: 'click'
            },
            mode1: 'single',
            selectedDate1: null,
            visibility1: {
            visibility: 'click'
            },
            nominas: []
        }
    },
    props: ['idafiliado','idempleado'],
    components: {
    'v-date-picker': DatePicker
    },
    mounted(){
        $("input[data-v-64ee1ddd]").removeClass()
        $("input[data-v-64ee1ddd]").addClass('uk-input gk-shadow-input')
        $("input[data-v-64ee1ddd]").css("padding-left","35px")
    //axios
    axios
      .get('../procesarNomina/0/'+this.idafiliado+'/'+this.idempleado)
      .then(response => (this.nominas=response.data))
    },
    methods: {
      async filtrar()
        {
            if(this.selectedDate != null && this.selectedDate1 != null)
            {
                axios
                .get('../procesarNomina/0/'+this.idafiliado+'/'+this.idempleado+'/'+JSON.stringify({
                    desde: this.selectedDate,
                    hasta: this.selectedDate1
                }))
                .then(response => (this.nominas=response.data))
            }else{
                swal("Filtros","Por favor, selecciona una fecha valida", "error")
            }
        }
    }
}
</script>
