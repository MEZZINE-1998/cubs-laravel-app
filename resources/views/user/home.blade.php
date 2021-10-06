@extends('layouts.app')

@section('content')


<div class="container" id="app" style="margin-top: 50px">
    <div class="row">
      <div class="col-md-3">
        <div class="col-md-12 align-items-center text-center" style="background-color: white; padding: 30px; border-radius: 4px; margin-bottom: 8px; box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, .1); border-top: 5px solid #fc9330">
          <img v-if="user.gender == 'Homme'" src="{{url('male.jpg')}}" height="160px" style="border-radius: 50%; border: 1px solid #fc9330">
          <img v-else src="{{url('female.jpg')}}" height="160px" style="border-radius: 50%; border: 1px solid #fc9330">
          <br><br>
          <span><b>Nom</b>  @{{user.name}}</span><br>
          <span><b>Matricule</b>  @{{user.matricule}}</span><br>
          <span><b>Categorie</b>  @{{user.categorie}}</span><br>
          <span><b>Sous categorie</b>  @{{user.categorie_joueur}}</span><br>
          <span><b>Email</b>  @{{user.email}}</span><br><br>
          <a v-if="user.id == auth.id" href="{{url('/profileuser')}}" class="btn btn-success btn-sm">Update</a>
        </div>
      </div>
      <div class="col-md-8">
        <!-- list des tests -->
        <span v-if="user.categorie == 'Joueur'">
          <h5># tests</h5>
          <div class="row">
            <span v-for="test in tests" class="col-md-4">
              <div class="userStyle row">
                <div class="col-md-12">
                  <b>Date @{{test.date}}</b><br><br>
                  Qualités mentales  <b>@{{moyenne(JSON.parse(test.test).first_critere)}} / 20</b><br>
                  Habiletés Techniques  <b>@{{moyenne(JSON.parse(test.test).sec_critere)}} / 20</b><br>
                  Habiletés Tactiques  <b>@{{moyenne(JSON.parse(test.test).thi_critere)}} / 20</b><br>
                  Qualités physiques  <b>@{{moyenne(JSON.parse(test.test).fou_critere)}} / 20</b><br><br>
                  <span class="row">
                    <span class="col-md-6">
                      <button @click="testMoreInfoTestFunction(test)" class="btn btn-light btn-sm" style="border-radius: 20px; width: 110px;">Plus d'info</button>
                    </span>
                    @if(Auth::user()->categorie != 'Joueur')
                    <span class="col-md-6">
                      <button @click="deleteTest(test)" class="btn btn-danger btn-sm" style="background: none; color: #f03e4e ;border-radius: 20px; width: 110px">Supprimer</button>
                    </span>
                    @endif
                  </span>
                </div>
              </div>
            </span>
          </div>
        </span>

        <!-- list Absences -->
        <br>
        <h5># bsences</h5>
        <div v-for="absence in absences">
          <div v-if="JSON.parse(absence.absences).includes(user.id)">
            @{{absence.date}} <b> - </b>
          </div>
        </div>
      </div>
      <div v-if="moreInfoTest != 0">
        <span class="moreInfoTestStyle">
          <div class="row text-right">
            <span style="cursor: pointer;" @click="moreInfoTest = 0"><i class="fas fa-times"></i></span>
          </div>
          <b>Date @{{testMoreInfo.date}}</b><br><br>
          <hr>
          <div class="row">
            <div class="col-md-3">
              <h6>## Qualités mentales @{{moyenne(JSON.parse(testMoreInfo.test).first_critere)}} / 20</h6>
              <span v-for="sc in JSON.parse(testMoreInfo.test).first_critere.sous_criteres">
                <b># @{{sc.titre}} :</b><br>
                <span v-for="note in sc.notes">
                  <small>@{{note.titre}} @{{note.note1}}</small><br>
                </span>
              </span>
            </div>
            <div class="col-md-3">
              <h6>## Habiletés Techniques @{{moyenne(JSON.parse(testMoreInfo.test).sec_critere)}} / 20</h6>
              <span v-for="sc in JSON.parse(testMoreInfo.test).sec_critere.sous_criteres">
                <b># @{{sc.titre}} :</b><br>
                <span v-for="note in sc.notes">
                  <small>@{{note.titre}} @{{note.note1}}</small><br>
                </span>
              </span>
            </div>
            <div class="col-md-3">
              <h6>## Habiletés Tactiques @{{moyenne(JSON.parse(testMoreInfo.test).thi_critere)}} / 20</h6>
              <span v-for="sc in JSON.parse(testMoreInfo.test).thi_critere.sous_criteres">
                <b># @{{sc.titre}} :</b><br>
                <span v-for="note in sc.notes">
                  <small>@{{note.titre}} @{{note.note1}}</small><br>
                </span>
              </span>
            </div>
            <div class="col-md-3">
              <h6>## Qualités physiques @{{moyenne(JSON.parse(testMoreInfo.test).fou_critere)}} / 20</h6>
              <span v-for="sc in JSON.parse(testMoreInfo.test).fou_critere.sous_criteres">
                <b># @{{sc.titre}} :</b><br>
                <span v-for="note in sc.notes">
                  <small>@{{note.titre}} @{{note.note1}}</small><br>
                </span>
              </span>
            </div>
          </div>
        </span>
      </div>
    </div>
  </div>      

@endsection


@section('javascripts')

<script src="{{ asset('js/vue.min.js') }}"></script>
<script src="{{ asset('https://unpkg.com/axios/dist/axios.min.js') }}"></script>

<script>
  window.Laravel ={!! json_encode([
      'csrfToken' => csrf_token(),
      'url'   =>  url('/'),
      'user'  =>  $user,
      'absences' => $absences,
      'tests' => $tests,
      'auth' => Auth::user(),
    ]) !!};
</script>

<script>
  
    var app = new Vue({
      el : '#app',
      data :{
        user:{
          name: '',
          matricule: '',
          gender:'',
          categorie: '',
          categorie_joueur:'',
          email: '',
          password : '',
          passwordconfirm: '',
        },
        absences : [],
        tests: [], 
        moreInfoTest: '0',
        auth: {},
      },
      methods:{

        testMoreInfoTestFunction(test){
          this.testMoreInfo = test;
          this.moreInfoTest = 1;
        },

        deleteTest(test){
          axios.delete(window.Laravel.url+"/deletetest/"+test.id)
          .then(response =>{
            this.tests = response.data.tests;  
          })
          .then(error =>{
            console.log(error);
          })
        },

        moyenne(input){
          var somme = 0;
          var len = 0;
          for (var i = 0; i < input.sous_criteres.length; i++) {
            len += Number(input.sous_criteres[i].notes.length);
            for (var j = 0; j < input.sous_criteres[i].notes.length; j++) {
              somme += Number(input.sous_criteres[i].notes[j].note1);
            }
          }
          return somme/len;
        },


      },

      created:function(){
        this.user = window.Laravel.user;
        this.absences = window.Laravel.absences;
        this.tests = window.Laravel.tests;
        this.auth = window.Laravel.auth;
      },

    });


</script>

@endsection
