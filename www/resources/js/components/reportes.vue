<template>
  <div>
    <h1 class="titulo-seccion">Reportes</h1>
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
                <th>titulo</th>
                <th>correo</th>
                <th>opciones</th>
            </tr>
        </thead>
        <tbody v-for="reporte in reportes">
            <tr>
                <td>{{reporte['id']}}</td>
                <td>{{reporte['fecha']}}</td>
                <td>{{reporte['titulo']}}</td>
                <td>{{reporte['mail']}}</td>
                <td><a href="#" uk-toggle="target: #modal-center" @click="mostrar(reporte)">Responder</a></td>
            </tr>
        </tbody>
    </table>
    <div id="modal-center" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
        <div class="uk-modal-header">
        <h2 class="uk-modal-title">Responder</h2>
        </div>
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-margin">
        <div class="uk-inline">
        <span class="uk-form-icon" uk-icon="icon: mail"></span>
        <input class="uk-input field" type="mail" id="mail" placeholder="Correo eléctronico" disabled="true" v-model="mail" required>
        </div>
        </div>
        <div class="mensajeReporte barra">
            <b>{{titulo}}</b>
            <pre>{{contenido}}</pre>
        </div>
        <hr>
        <div class="uk-margin">
        <textarea class="uk-textarea" id="content" v-model="respuesta" rows="4" maxlength="590" placeholder="Responde a esta solicitud aquí..." required></textarea>
        </div>
        <center>
            <button class="uk-button uk-button-primary" @click="responder">Responder</button>
        </center>
        </div>
        </div>
  </div>
</template>

<script>
import $ from 'jquery'
import swal from 'sweetalert'
import DatePicker from 'v-calendar/lib/components/date-picker.umd'

export default {
    name: 'reporte',
    data() {
        return{
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
            reportes: [],
            mail: '',
            titulo: '',
            contenido: '',
            respuesta: '',
            asunto: '',
            id: 0
        }
    },
    components: {
    'v-date-picker': DatePicker
    },
    mounted(){
        $("input[data-v-64ee1ddd]").removeClass()
        $("input[data-v-64ee1ddd]").addClass('uk-input gk-shadow-input')
        $("input[data-v-64ee1ddd]").css("padding-left","35px")
    //axios
    axios
      .get('../procesarReportes/0')
      .then(response => (this.reportes=response.data))
    },
    methods: {
        async filtrar()
        {
            if(this.selectedDate != null && this.selectedDate1 != null)
            {
                await axios
                .get('../procesarReportes/0/'+JSON.stringify({
                    desde: this.selectedDate,
                    hasta: this.selectedDate1
                }))
                .then(response => (this.reportes=response.data))
            }else{
                axios
                    .get('../procesarReportes/0')
                    .then(response => (this.reportes=response.data))
            }
        },
        async responder()
        {
            await axios
                .post('../procesarReportes/2/',{
                    correo: this.mail,
                    contenido: this.respuesta,
                    titulo: this.asunto,
                    id: this.id
                })
                .then(response => (swal(response.data[0],response.data[1],response.data[2])))
                this.filtrar()
                $('#modal-center').removeClass('uk-open').hide();
                this.respuesta = ""
        },
        mostrar(reporte)
        {
            this.titulo = reporte['titulo']
            this.mail = reporte['mail']
            this.contenido = reporte['contenido']
            this.asunto = reporte['titulo']
            this.id = reporte['id']
        }
    }
}
</script>
