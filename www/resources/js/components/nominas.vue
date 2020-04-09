<template>
  <div>
    <h1 class="titulo-seccion">Nominas</h1>
    Llena el siguiente formulario:<br>
    <center>
    <table>
      <tr>
        <td><h3 class="titulo-seccion">Devengado</h3></td><td><h3 class="titulo-seccion">Nominas</h3></td>
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
    </center>
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
            vacaciones: 0
        }
    },
    props:['idafiliado'],
    mounted(){
      $('#nomina').hide();
    },
    methods: {
      async nomina()
      {
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
        this.totaldevengado = this.salariod+this.horase+this.recargo+this.dominicales+this.auxiliot

        //deducciones
        this.salud = parseFloat(this.salariod*0.04)
        this.pension = parseFloat(this.salariod*0.04)
        this.fsp = parseFloat(this.salariob > (877803*4) ? (this.salariod*0.01) : 0 )
        this.totaldeducciones = this.salud+this.pension+this.fsp+this.deducciones

        this.totalpagar = this.totaldevengado-this.totaldeducciones

        //seguridad social
        this.esalud = parseFloat(this.salariod*0.085)
        this.epension = parseFloat(this.salariod*0.12)
        this.earl = parseFloat(this.salariod*0.00522)
        this.totalss = this.esalud+this.epension+this.earl

        //aportes parafiscales
        this.sena = parseFloat(this.salariob*0.02)
        this.caja = parseFloat(this.salariob*0.04)
        this.icbf = parseFloat(this.salariob*0.03)
        this.tap = this.sena+this.caja+this.icbf

        //prestaciones sociales
        this.cesantias = parseFloat((this.salariod)/360)
        this.isc = parseFloat(((this.cesantias*parseInt(this.dias))*0.12)/360)
        this.prima = parseFloat((this.salariod)/360)
        this.vacaciones = parseFloat((this.salariod)/720)
        this.tps = this.cesantias+this.isc+this.prima+this.vacaciones

        this.totalapropiaciones = this.totalss+this.tap+this.tps

        this.totalnomina = this.totalpagar+this.totalapropiaciones
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
                .post('../procesarNomina/1')
                .then(response => (swal(response.data[0],response.data[1],response.data[2])))
      }
    }
}
</script>
