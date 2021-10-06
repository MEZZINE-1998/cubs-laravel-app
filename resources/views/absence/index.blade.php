@extends('layouts.app')

@section('content')


<div class="container" id="app" style="margin-top: 60px">
      <div class="row">
          <div class="col-md-6">
            <h4># Nouvelle absences</h4>
            <div class="text-center" style="background-color: #fff; border-radius: 4px; padding: 30px; box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, .1); border-top: 5px solid #fc9330">
              <h6 class="text-left"># filtres</h6>
              <div class="row" style="margin-bottom: 15px">
                <div class="col-md-4">
                  @if(Auth::user()->categorie == 'Admin')
                  <input list="categorie" type="text" class="form-control" required v-model="categorie">
                  <datalist id="categorie">
                    <option value="Educateur">Educateur</option>
                    <option value="Joueur">Joueur</option>
                  </datalist> 
                  @else
                  <span v-if="categorie = 'Joueur'"></span>
                  @endif
                </div>
                <span v-if="categorie != 'Joueur'">
                  <span v-if="gender = ''"></span>
                  <span v-if="categorie_joueur = ''"></span>
                </span>
                <div v-if="categorie == 'Joueur'" class="col-md-4">
                  <input list="gender" type="text" class="form-control" required v-model="gender">
                  <datalist id="gender">
                    <option value="Homme">Homme</option>
                    <option value="Femme">Femme</option>
                  </datalist>
                </div>
                <div v-if="categorie == 'Joueur'" class="col-md-4">
                  <input list="catJoueur" type="text" class="form-control" required v-model="categorie_joueur">
                  <datalist id="catJoueur">
                    <option value="U8">U8</option>
                    <option value="U10">U10</option>
                    <option value="U12">U12</option>
                    <option value="U14">U14</option>
                  </datalist>
                </div>
              </div>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Avatar</th>
                    <th class="text-left" scope="col">name</th>
                    <th class="text-left" scope="col">matricule</th>
                    <th scope="col" class="text-right">Absent</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="user in getFilteredUsers">
                    <th scope="row">
                      <img v-if="user.gender == 'Homme'" src="male.jpg"  class="rounded-circle" width="30">
                      <img v-else src="female.jpg"  class="rounded-circle" width="30">
                    </th>
                    <td class="text-left"><a :href="'userhome/' + user.id">@{{ user.name }}</a></td>
                    <td class="text-left">@{{ user.matricule }}</td>
                    <th scope="col" class="text-right">
                      <input class="form-check-input" type="checkbox" :id="user.id" :value="user.id" v-model="absence.absences">
                    </th>
                  </tr>
                </tbody>
              </table>
              <div class="text-left">
                <button class="btn btn-dark" @click="addAbsence">Save</button>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <h4># List des absences</h4>
              <div v-for="abs in absences" style="background: white; padding: 15px; margin-bottom: 7px; border-radius: 4px; box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, .2);">
              <b>@{{abs.date}}</b>
              @if(Auth::user()->categorie == 'Admin')
              <span class="col-md-12 text-right">
                <a @click="deleteAbsence(abs)" class="btn btn-danger btn-sm" style="float: right ;background: none; color: #f03e4e ;border-radius: 20px; width: 110px">Delete</a>
              </span>
              @endif
              <br><br>
              <div v-for="x in filterUsersFromAbsenceList(JSON.parse(abs.absences))">
                <a style="cursor: pointer; color: #8f8f8f">(@{{x.categorie}}<span v-if="x.categorie == 'Joueur'"> | @{{x.categorie_joueur}}</span>) @{{x.name}}</a>
              </div>    
            </div>
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
    ]) !!};
</script>

<script>
  
    var app = new Vue({
      el : '#app',

      data :{
        users: [],
        gender: '',
        categorie: '',
        categorie_joueur: '',
        passwordconfirm : '',

        absences: [],
        absence:{
          date: '',
          absences: [],
          json_absences: {},
        },
        absenceEmpty:{
          date: '',
          absences: [],
        },
      },
      

      computed: {
        getFilteredUsers() {
           return this.filterUsersCategorie(this.filterUsersGender(this.filterUsersCategorieJoueur(this.filterUsersWithoutAdmin(this.users))))
        },
      },


      methods:{

        filterUsersWithoutAdmin(users){
          return users.filter(user => user.categorie.indexOf('Admin'))
        },
        filterUsersCategorie(users){
          return users.filter(user => !user.categorie.indexOf(this.categorie))
        },
        filterUsersGender(users){
          return users.filter(user => !user.gender.indexOf(this.gender))
        },
        filterUsersCategorieJoueur(users){
          return users.filter(user => !user.categorie_joueur.indexOf(this.categorie_joueur))
        },


        filterUsersFromAbsenceList(absence){
          var result = [];
          for (var i = 0, len = this.users.length; i < len; i++) {
            if (absence.includes(this.users[i].id)) 
            {
                result.push(this.users[i]);
            }   
          }
          return result;
        },



        addAbsence() {
          this.absence.json_absences = JSON.stringify(this.absence.absences);
          console.log(this.absence.date+this.absence.json_absences);
          // then send absence          
          axios.post(window.Laravel.url+"/addabsence", this.absence)
          .then(response =>{
            console.log(response.data.absences);
            this.absence = this.absenceEmpty;
            this.absences = response.data.absences;
            this.absence.json_absences = {}
            Swal.fire(
              '',
              'A new account has been created',
              'success',
            )
          })
          .then(error =>{
            console.log(error);
            this.absence = this.absenceEmpty;
          })
        },


        getUsers: function(){
          axios.get(window.Laravel.url+"/getusers")
          .then(response => {
            this.users = response.data;
            console.log(this.users);
          })
          .catch(error => {
            console.log('errors: ',error);
          })
        },


        getAbsences: function(){
          axios.get(window.Laravel.url+"/getabsences")
          .then(response => {
            this.absences = response.data;
            console.log(this.absences);
          })
          .catch(error => {
            console.log('errors: ',error);
          })
        },

        deleteAbsence(absence){
          axios.delete(window.Laravel.url+"/deleteabsence/"+absence.id)
          .then(response =>{
            this.absences = response.data.absences;  
          })
          .then(error =>{
            console.log(error);
          })
        },

      },

      created:function(){
        this.getUsers();
        this.getAbsences();
      },


    });


</script>

@endsection
