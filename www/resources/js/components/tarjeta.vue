<template>
  <div style="overflow:hidden;">
    <h1 class="titulo-seccion">Tus tarjetas</h1>
    Para acceder a la información de tu tarjeta, debes darle click a la imagen.
    <div v-for="tarjeta in tarjetas" v-if="rango==0">
            <center>
            <a  uk-toggle="target: #modal-center"><img src="img/tarjeta.png" style="width:700px;"></a>
            <span class="codigoTarjeta">
            <barcode v-bind:value="tarjeta['idcliente']" format="CODE39" width="3" height="50">
            Error generando codigo de barras
            </barcode>
            </span>
            <span class="numeroTarjeta">{{agregarCeros(tarjeta['id'])}}</span>
            <span class="nombreTarjeta">{{tarjeta['nombre']}}</span>
            </center>
        <div id="modal-center" class="uk-flex-top" uk-modal>
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="creadorForm">
                <h3 class="title">Datos de tu tarjeta</h3>
                <div class="tarjetaInformacion">
                    <b>Saldo: {{miles(tarjeta['saldo'])}}</b><br>
                    <b>Puntos: {{tarjeta['puntos']}}</b>
                    <hr>
                    Los puntos te pueden hacer acreedor de premios increíbles.<br>
                    Entre más compres en nuestros almacenes, o sitio web, más probabilidades de ganar tendrás.
                </div>
            </div>
        </div>
    </div>
    <div v-if="rango>0"><b>Debido a que eres empleado, no posees una tarjeta.</b></div>
  </div>
</template>

<script>
import $ from 'jquery'
import swal from 'sweetalert'
import VueBarcode from 'vue-barcode';

export default {
  name: 'tarjeta',
  data() {
    return {
        tarjetas: [],
        informacion: ''
    }
  },
  props: ['idcliente','rango'],
  mounted(){
    //axios
    axios
      .get('../procesarTarjetas/0/'+this.idcliente)
      .then(response => (this.tarjetas=response.data))
  },
  components: {
    'barcode': VueBarcode
  },
  methods: {
    agregarCeros(id)
    {
      let numero
      numero = id.toString()
      for(let i=0;i<11;i++)
      {
        if(numero.length < i)
        {
          numero='0'+numero;
        }
      }
      return numero;
    },
    miles(input)
    {
    var num = input;
    if(!isNaN(num)){
      num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
      num = num.split('').reverse().join('').replace(/^[\.]/,'');
      return num;
      }
    }
  }
};
</script>
