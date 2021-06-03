@extends('layouts.app')

@section('content')

<div id="app3" class="container" style="margin-top: 60px">
   	  <div class="row">
   	  		<div class="col-md-12" style="margin-bottom: 15px">
            <div class="row">
              <div class="col-md-2 text-left">
                <b style="font-size: 20px; margin-bottom: 8px">Engineers</b>
              </div>
              <div class="col-md-6" style="margin-bottom: 8px">
                <input v-model="keyword" class="form-control" id="search" type="text" placeholder="Search.. " style="background: none">
              </div>
              <div class="col-md-2" style="margin-bottom: 8px">
                <input v-model="searchPrice" class="form-control" id="searchPrice" type="text" placeholder="Max rate... €/day" style="background: none">
              </div>
              <div class="col-md-2 text-right" style="margin-bottom: 8px">
                @if(Auth::user()->post == "admin")
                <a href="{{ url('cvs/create') }}"  class="btn btn-primary" style="font-size: 16px">New account</a>
                @endif
                @if(Auth::user()->post == "Entreprise")
                <a  v-if="add_to_cart_count != 0" href="{{ url('user/'.Auth::user()->id) }}" class="btn btn-success" style="font-size: 16px">Selected (@{{add_to_cart_count}})</a>
                @endif
              </div>
            </div>
          </div>

        @if(Auth::user()->post == "Entreprise")
        <small v-if="getFilteredIngs.length == 0" class="col-md-8 offset-md-2">
          <br>  
          <br>  
          <h6>Sorry, we couldn't find any engineers</h6>
          <br>
          <textarea rows="9" class="form-control" v-model="commentaireRequest" type="text" placeholder="feel free to send the requested skills"></textarea>
          <br>
          <span @click="sendRequestIngs" class="btn btn-success">Send your request</span>

        </small>
        @endif


				<div class="row">

            @if(Auth::user()->post == "Entreprise")
  					<div v-else v-for="ing in getFilteredIngs" v-if="
            ing.dispo == 1 && ing.add_to_cart == 0 && (ing.tarif <= searchPrice || searchPrice == '') || ing.dispo == 1 && ing.add_to_cart == 1 && ing.add_to_cart_id_ent == AuthId && (ing.tarif <= searchPrice || searchPrice == '')" 
            class="col-md-3">
            @else
            <div v-else v-for="ing in getFilteredIngs" v-if="ing.tarif <= searchPrice || searchPrice == '' " class="col-md-3">
            @endif
                <div class="card-deck" style="margin-bottom: 1rem">
                  <div class="card">
                  <a :href="'cvs/' + ing.id"><img :src="'storage/'+ing.image" class="card-img-top imgShape" alt="..."></a>

                  <div class="card-body">
                    <h5 class="card-title">@{{ ing.name }}</h5>
                    <p><strong>@{{ ing.titre }}</strong></p>
                    <small class="card-text textLimitLine">@{{ ing.description }}</small>
                    <br>

                    <form method="post" :action="'cvs/'+ing.id" style="margin-top: 20px"> 
                       {{csrf_field()}}
                       {{method_field('DELETE')}}
                       @if(Auth::user()->post !== "Ingenieur")
                       <em style="float: left;"><b>@{{ ing.tarif }}</b>€/day</em>
                       @endif
                       @if(Auth::user()->post == "admin")
                       <span @click="deleleIng(ing)" class="delete-icon"><i class="fas fa-trash-alt"></i></span>
                       @endif
                       @if(Auth::user()->post == "Entreprise")
                       <span v-if="ing.add_to_cart == 0" @click="addtocart(ing)" style="color: grey; float: right; font-size: 15px">select <i class="far fa-circle"></i></span>
                       <span v-if="ing.add_to_cart == 1" @click="deletefromcart(ing)" style="color: green; float: right; font-size: 15px">selected <i class="fas fa-check-circle"></i></span>
                       @endif
                       @if(Auth::user()->post == "Ingenieur")
                       <a :href="'cvs/' + ing.id" class="see-icon"><i class="fas fa-user"></i></a>
                       @endif
                    </form>

                  </div>
                </div>
              </div>
            </div>

   	  		</div>
   	  </div>
	</div>
</div>


<style type="text/css">

.imgShape {
    width:  100%;
    height: 250px;
    object-fit: cover;
}

.textLimitLine {
   overflow: hidden;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 4; /* number of lines to show */
   -webkit-box-orient: vertical;
}

.delete-icon{
  color: red;font-size: 15px;background: none;border:none;outline: none;cursor: pointer; 
  float: right;
}
.see-icon{
  color: #6592d6 ;
  font-size: 15px;
  background: none;
  border:none;
  outline: none;
  cursor: pointer; 
  float: right;
  margin-right: 6px;
}
</style>




@endsection



@section('javascripts')
<script src="{{ asset('js/vue.min.js') }}"></script>
<script src="{{ asset('https://unpkg.com/axios/dist/axios.min.js') }}"></script>
<script src="{{ asset('https://unpkg.com/jspdf@latest/dist/jspdf.min.js') }}"></script>
<script src="{{ asset('https://code.jquery.com/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js_pdf/html2canvas.min.js') }}"></script>


<script>
  window.Laravel ={!! json_encode([
      'csrfToken' => csrf_token(),
      'AuthId' => Auth::user()->id,
      'url'   =>  url('/')
    ]) !!};
</script>

<script>
  
    var app = new Vue({
      el : '#app3',

      data :{
        commentaireRequest: '',
        AuthId: window.Laravel.AuthId,
        keyword: '',
        searchPrice: '',
        ings: [],
        exps: [],
        forms: [],
        certs: [],
        skis: [],
        add_to_cart_count: 0,
      },
      methods:{


        deleleIng(ing){
          axios.post(window.Laravel.url+'/deleteing',ing)
          .then(res => {
            this.ings = res.data.ings;
          })
        },

        sendRequestIngs(){
          axios.post(window.Laravel.url+'/sendRequestIngs', {commentaire: this.commentaireRequest, id_entreprise : this.AuthId})
          .then(res => {
            console.log("request : "+res.data);
            this.commentaireRequest = "";
          })
          Swal.fire(
            '',
            'Your request has been saved successfully',
            'success',
          )
        },

        addtocart(ing){
          axios.post(window.Laravel.url+'/addtocart',ing)
          .then(res => {
            this.ings = res.data.ings;
            this.add_to_cart_count = res.data.ings.filter(ing => ing.add_to_cart === 1  && ing.add_to_cart_id_ent === this.AuthId).length;
          })
        },

        deletefromcart(ing){
          axios.post(window.Laravel.url+'/deletefromcart',ing)
          .then(res => {
            this.ings = res.data.ings;
            this.add_to_cart_count = res.data.ings.filter(ing => ing.add_to_cart === 1  && ing.add_to_cart_id_ent === this.AuthId).length;
          })
        },

        getResults() {
            axios.get(window.Laravel.url+'/livesearch', { params: { keyword: this.keyword } })
                .then(res => {
                  this.ings = res.data.ings;
                  this.exps = res.data.exps;
                  this.forms = res.data.forms;
                  this.certs = res.data.certs;
                  this.skis = res.data.skis;
                  this.add_to_cart_count = res.data.ings.filter(ing => ing.add_to_cart === 1  && ing.add_to_cart_id_ent === this.AuthId).length;
                })
                .catch(error => {
                  console.log('errors: ',error);
                });
          }

        },
        created:function(){
          this.getResults();
        },

      computed: {
            getFilteredIngs() {

              var listExps = this.exps.filter(
                 exp => {
                    var v1 = exp.titre;
                    var v2 = exp.commentaire;
                    
                    if (v1 == null) {
                      v1 = '';
                    }
                    if(v2 == null){
                      v2 = '';
                    }

                    var vAll = v2.concat(v1);
                    return vAll.toLowerCase().includes(this.keyword.toLowerCase());
                 }
              );

              var listForms = this.forms.filter(
                 form => {
                    var v1 = form.titref;
                    var v2 = form.commentairef;

                    if (v1 == null) {
                      v1 = '';
                    }
                    if(v2 == null){
                      v2 = '';
                    }

                    var vAll = v2.concat(v1);
                    return vAll.toLowerCase().includes(this.keyword.toLowerCase());
                 }
              );

              var listCerts = this.certs.filter(
                 form => {
                    var v1 = form.titrec;
                    var v2 = form.commentairec;

                    if (v1 == null) {
                      v1 = '';
                    }
                    if(v2 == null){
                      v2 = '';
                    }

                    var vAll = v2.concat(v1);
                    return vAll.toLowerCase().includes(this.keyword.toLowerCase());
                 }
              );

              var listSkis = this.skis.filter(
                 ski => {
                    var v1 = ski.commentaire;
                    
                    if (v1 == null) {
                      v1 = '';
                    }

                    var vAll = v1;

                    return vAll.toLowerCase().includes(this.keyword.toLowerCase());
                 }
              );

              var listIngs = this.ings.filter(
                 ing => {
                    var v1 = ing.titre;
                    var v2 = ing.description;
                    var v3 = ing.name;

                    if (v1 == null) {
                      v1 = '';
                    }
                    if(v2 == null){
                      v2 = '';
                    }
                    if(v3 == null){
                      v3 = '';
                    }

                    var vAll = v2.concat(v1).concat(v3);

                    return vAll.toLowerCase().includes(this.keyword.toLowerCase());
                 }
              );

              list_id_ings = listIngs.map((obj) => obj.id);
              list_id_exps = listExps.map((obj) => obj.cv_id);
              list_id_fors = listForms.map((obj) => obj.cv_id);
              list_id_cers = listCerts.map((obj) => obj.cv_id);
              list_id_skis = listSkis.map((obj) => obj.cv_id);


              var ids = list_id_exps.concat(list_id_fors).concat(list_id_cers).concat(list_id_skis).concat(list_id_ings);
              ids = ids.filter((v, i, a) => a.indexOf(v) === i);


              if (ids.length == 0) {
                return [];
              }
              else{
                var result = [];
                for (var i = 0, len = ids.length; i < len; i++) {

                    var item = this.ings.find(
                      function(post, index) {
                      if(post.id == ids[i])
                        return true;
                    });
                    result.push(item);
                }
                console.log(result);
                // console.log(this.add_to_cart_count);
                var result = result.filter(function (el) {
                  return el != null;
                });
                return result;
              }

            },

        },


    });


</script>

@endsection