<template>
  <div>
    <h1 class="titulo-seccion">Nominas</h1>
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
    <center>
    <table class="uk-table uk-table-small uk-table-divider">
        <thead>
            <tr>
                <th><b>ID</b></th>
                <th>fecha</th>
                <th>idempleado</th>
                <th>devengado</th>
                <th>deducido</th>
                <th>total pagado</th>
                <th>total nomina</th>
                <th>opciones</th>
            </tr>
        </thead>
        <tbody v-for="nomina in nominas">
            <tr>
                <td>{{nomina['id']}}</td>
                <td>{{nomina['fecha']}}</td>
                <td>{{nomina['idempleado']}}</td>
                <td>{{nomina['totaldevengado']}}</td>
                <td>{{nomina['totaldeducido']}}</td>
                <td>{{nomina['totalpago']}}</td>
                <td>{{nomina['totalnomina']}}</td>
                <td><a href="#" @click="eliminar(nomina)">Eliminar</a></td>
            </tr>
        </tbody>
    </table>
    </center>
    <center>
      <button class="uk-button uk-button-primary" @click="formulario">Crear nomina</button>
    </center>
    <br>
    <br>
    <div id="modal-center" class="uk-flex-top" uk-modal>
        <div class="creadorForm">
          <table>
      <tr>
        <td><h3 class="titulo-seccion">Devengado</h3></td><td><h3 class="titulo-seccion">Deducciones</h3></td>
      </tr>
      <tr>
        <td>
      <tr>
        <td>ID del empleado:</td>
        <td>
          <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input field" type="text" name="idusuario" placeholder="ID empleado..." required v-model="idusuario">
          </div>
          </div>
        </td>
      </tr>
      <tr>
        <td>Días trabajados:</td>
        <td>
          <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: hashtag"></span>
            <input class="uk-input field" type="text" name="dias" placeholder="Dias trabajados..." required v-model="dias">
          </div>
          </div>
        </td>
      </tr>
      <tr>
        <td>Horas extras:</td>
        <td>
          <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: hashtag"></span>
            <input class="uk-input field" type="text" name="horas" placeholder="Horas trabajadas..." required v-model="horas">
          </div>
          </div>
        </td>
      </tr>
      <tr>
        <td>Horas nocturnas:</td>
        <td>
          <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: hashtag"></span>
            <input class="uk-input field" type="text" name="horasn" placeholder="Horas nocturnas trabajadas..." required v-model="horasn">
          </div>
          </div>
        </td>
      </tr>
      <tr>
        <td>Horas dominicales y festivos:</td>
        <td>
          <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: hashtag"></span>
            <input class="uk-input field" type="text" name="horasd" placeholder="Horas dominicales y festivos trabajadas..." required v-model="horasd">
          </div>
          </div>
        </td>
      </tr>
      </td>
      <td>
      <tr>
        <td>Otras deducciones:</td>
        <td>
          <div class="uk-margin">
          <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: hashtag"></span>
            <input class="uk-input field" type="text" name="deducciones" placeholder="Otras deducciones..." required v-model="deducciones">
          </div>
          </div>
        </td>
      </tr>
      </td>
      </tr>
      <tr>
        <td colspan="2">
          <center>
            <button class="uk-button uk-button-primary" @click="nomina">Generar nomina</button>
          </center>
        </td>
      </tr>
    </table>
    <button class="uk-modal-close-default" type="button" uk-close></button>
        </div>
    </div>
    <div id="nomina" ref="nomina">
      <h2 class="titulo-seccion">Valor pago empleado</h2>
      <!-- DEVENGADO -->
      <h3 class="titulo-seccion">Devengado</h3>
      <div class="uk-overflow-auto tabla barra">
    <table class="uk-table uk-table-small uk-table-divider">
        <thead>
            <tr>
                <th><b>Empleado</b></th>
                <th>Salario básico</th>
                <th>Salario devengado</th>
                <th>Horas extras</th>
                <th>Recargos nocturnos</th>
                <th>Dominicales y festivo</th>
                <th>Auxilio de transporte</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{empleado['nombres']+" "+empleado['apellidos']}}</td>
                <td>{{salariob}}</td>
                <td>{{salariod}}</td>
                <td>{{horase}}</td>
                <td>{{recargo}}</td>
                <td>{{dominicales}}</td>
                <td>{{auxiliot}}</td>
            </tr>
        </tbody>
    </table>
    </div>
    <hr>
    Total devengado: {{totaldevengado}}
    <!-- DEDUCCIONES -->
    <h3 class="titulo-seccion">Deducciones</h3>
      <div class="uk-overflow-auto tabla barra">
    <table class="uk-table uk-table-small uk-table-divider">
        <thead>
            <tr>
                <th><b>Empleado</b></th>
                <th>Salud</th>
                <th>Pensión</th>
                <th>Fondo de solidaridad pensional</th>
                <th>Otras deducciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{empleado['nombres']+" "+empleado['apellidos']}}</td>
                <td>{{salud}}</td>
                <td>{{pension}}</td>
                <td>{{fsp}}</td>
                <td>{{deducciones}}</td>
            </tr>
        </tbody>
    </table>
    </div>
    <hr>
    Total deducciones: {{totaldeducciones}}
      <h4 class="titulo-seccion">Total a pagar: {{totalpagar}}</h4>
    <h2 class="titulo-seccion">Apropiaciones de nómina</h2>
    <!-- SEGURIDAD SOCIAL -->
    <h3 class="titulo-seccion">Seguridad social</h3>
      <div class="uk-overflow-auto tabla barra">
    <table class="uk-table uk-table-small uk-table-divider">
        <thead>
            <tr>
                <th><b>Empleado</b></th>
                <th>Salud</th>
                <th>Pensión</th>
                <th>ARL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{empleado['nombres']+" "+empleado['apellidos']}}</td>
                <td>{{esalud}}</td>
                <td>{{epension}}</td>
                <td>{{earl}}</td>
            </tr>
        </tbody>
    </table>
    </div>
    <hr>
    Total seguridad social: {{totalss}}
    <!-- APORTES PARAFISCALES -->
    <h3 class="titulo-seccion">Seguridad social</h3>
      <div class="uk-overflow-auto tabla barra">
    <table class="uk-table uk-table-small uk-table-divider">
        <thead>
            <tr>
                <th><b>Empleado</b></th>
                <th>Sena</th>
                <th>Caja de compensación</th>
                <th>ICBF</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{empleado['nombres']+" "+empleado['apellidos']}}</td>
                <td>{{sena}}</td>
                <td>{{caja}}</td>
                <td>{{icbf}}</td>
            </tr>
        </tbody>
    </table>
    </div>
    <hr>
    Total aportes parafiscales: {{tap}}
    <!-- PRESTACIONES SOCIALES -->
    <h3 class="titulo-seccion">Prestaciones sociales</h3>
      <div class="uk-overflow-auto tabla barra">
    <table class="uk-table uk-table-small uk-table-divider">
        <thead>
            <tr>
                <th><b>Empleado</b></th>
                <th>Cesantias</th>
                <th>Intereses sobre cesantias</th>
                <th>Prima</th>
                <th>Vacaciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{empleado['nombres']+" "+empleado['apellidos']}}</td>
                <td>{{cesantias}}</td>
                <td>{{isc}}</td>
                <td>{{prima}}</td>
                <td>{{vacaciones}}</td>
            </tr>
        </tbody>
    </table>
    </div>
    <hr>
    Total prestaciones sociales: {{tps}}
      <h4 class="titulo-seccion">Total apropiaciones: {{totalapropiaciones}}</h4>
      <h3 class="titulo-seccion">Total nomina: {{totalnomina}}</h3>
    </div>
    <center><button class="uk-button uk-button-danger" v-show="liquidada==1" @click="imprimir">Imprimir</button><button class="uk-button uk-button-primary" v-show="liquidada==1" @click="guardar">Guardar</button></center>
  </div>
</template>

<script>
import $ from 'jquery'
import swal from 'sweetalert'
import DatePicker from 'v-calendar/lib/components/date-picker.umd'

export default {
    name: 'nominas',
    data() {
        return{
            activo: 0,
            dias: 0,
            horas: 0,
            horasn: 0,
            horasd: 0,
            idusuario: '',
            deducciones: 0,
            empleado: {},
            liquidada:0,
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
            nominas: [],
            //devengado
            salariob: 0,
            salariod: 0,
            horase: 0,
            recargo: 0,
            dominicales: 0,
            auxiliot: 0,
            //deducciones
            salud: 0,
            pension: 0,
            fsp: 0,
            //totales
            totaldevengado: 0,
            totaldeducciones: 0,
            totalpagar: 0,
            totalss: 0,
            tap: 0,
            tps: 0,
            totalapropiaciones: 0,
            totalnomina: 0,
            //seguridadsocial
            esalud: 0,
            epension: 0,
            earl: 0,
            //aportes parafiscales
            sena: 0,
            caja: 0,
            icbf: 0,
            //prestaciones sociales
            cesantias: 0,
            isc: 0,
            prima: 0,
            vacaciones: 0,
        }
    },
    props:['idafiliado'],
    components: {
    'v-date-picker': DatePicker
    },
    mounted(){
      $('#nomina').hide();
      $("input[data-v-64ee1ddd]").removeClass()
      $("input[data-v-64ee1ddd]").addClass('uk-input gk-shadow-input')
      $("input[data-v-64ee1ddd]").css("padding-left","35px")
    //axios
    axios
      .get('../procesarNomina/2/'+this.idafiliado)
      .then(response => (this.nominas=response.data))
    },
    methods: {
      formulario()
      {
        $('#modal-center').addClass('uk-open').show();
      },
      async nomina()
      {
        $('#modal-center').removeClass('uk-open').hide();
        $('#nomina').show();
        await axios
                .get('../procesarAjustes/0/'+this.idafiliado+'/1/'+this.idusuario)
                .then(response => (this.empleado=response.data))
        //devengado
        this.salariob = parseInt(this.empleado['sueldo'])
        this.salariod = parseFloat((this.salariob/30)*parseInt(this.dias))
        this.horase = parseFloat(((this.salariod/720)*1.25)*parseInt(this.horas))
        this.recargo = parseFloat(((this.salariod/720)*0.35)*parseInt(this.horasn))
        this.dominicales = parseFloat(((this.salariod/720)*2)*parseInt(this.horasd))
        this.auxiliot = parseFloat(this.salariob < (877803*2) ? 102854 : 0 )
        this.totaldevengado = parseFloat(this.salariod+this.horase+this.recargo+this.dominicales+this.auxiliot)

        //deducciones
        this.salud = parseFloat(this.salariod*0.04)
        this.pension = parseFloat(this.salariod*0.04)
        this.fsp = parseFloat(this.salariob > (877803*4) ? (this.salariod*0.01) : 0 )
        this.totaldeducciones = parseFloat(this.salud+this.pension+this.fsp+parseFloat(this.deducciones))

        this.totalpagar = parseFloat(this.totaldevengado-this.totaldeducciones)

        //seguridad social
        this.esalud = parseFloat(this.salariod*0.085)
        this.epension = parseFloat(this.salariod*0.12)
        this.earl = parseFloat(this.salariod*0.00522)
        this.totalss = parseFloat(this.esalud+this.epension+this.earl)

        //aportes parafiscales
        this.sena = parseFloat(this.salariob*0.02)
        this.caja = parseFloat(this.salariob*0.04)
        this.icbf = parseFloat(this.salariob*0.03)
        this.tap = parseFloat(this.sena+this.caja+this.icbf)

        //prestaciones sociales
        this.cesantias = parseFloat((this.salariod)/360)
        this.isc = parseFloat(((this.cesantias*parseInt(this.dias))*0.12)/360)
        this.prima = parseFloat((this.salariod)/360)
        this.vacaciones = parseFloat((this.salariod)/720)
        this.tps = parseFloat(this.cesantias+this.isc+this.prima+this.vacaciones)

        this.totalapropiaciones = parseFloat(this.totalss+this.tap+this.tps)

        this.totalnomina = parseFloat(this.totalpagar+this.totalapropiaciones)
        this.liquidada=1
      },
      imprimir()
      {
        let ficha = this.$refs.nomina;
	      let ventimp = window.open(' ', 'popimpr');
	      ventimp.document.write( ficha.innerHTML );
	      ventimp.document.close();
	      ventimp.print( );
	      ventimp.close();
      },
      async guardar()
      {
        await axios
                .post('../procesarNomina/1',{
                  idafiliado: this.idafiliado,
                  idusuario: this.idusuario,
                  dias : this.dias,
                  hext : this.horas,
                  hn : this.horasn,
                  hdf : this.horasd,
                  ded : this.deducciones,
                  tdev : this.totaldevengado,
                  tded : this.totaldeducciones,
                  tpag : this.totalpagar,
                  tnom : this.totalnomina
                })
                .then(response => (swal(response.data[0],response.data[1],response.data[2])))
        this.filtrar();
      },
      async filtrar()
        {
            if(this.selectedDate != null && this.selectedDate1 != null)
            {
                axios
                .get('../procesarNomina/2/'+this.idafiliado+'/0/'+JSON.stringify({
                    desde: this.selectedDate,
                    hasta: this.selectedDate1
                }))
                .then(response => (this.nominas=response.data))
            }else{
                axios
                  .get('../procesarNomina/2/'+this.idafiliado)
                  .then(response => (this.nominas=response.data))
            }
        },
      async eliminar(nomina)
      {
        axios
        .get('../procesarNomina/3/'+nomina['idafiliado']+'/'+nomina['id']) //Filtros
        .then(response => (this.nominas = response.data))
        swal("La nomina ha sido eliminada", "", "success");
      }
    }
}
</script>
