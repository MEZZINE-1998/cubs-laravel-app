@extends('layouts.app')

@section('content')


<div class="container" id="app" style="margin-top: 40px">
  <div class="col-md-11 row">
      <!-- filtres -->
      <div class="row" style="margin-bottom: 15px">
        <h4 class="col-md-3"># All users</h4>
        <span class="col-md-3">
          <input list="categorie" type="text" class="form-control" required v-model="categorie" placeholder="categorie">
          <datalist id="categorie">
            <option value="Educateur">Educateur</option>
            <option value="Joueur">Joueur</option>
          </datalist> 
        </span>
        <span v-if="categorie != 'Joueur'">
          <span v-if="gender = ''"></span>
          <span v-if="categorie_joueur = ''"></span>
        </span>
        <span v-if="categorie == 'Joueur'" class="col-md-3">
          <input list="gender" type="text" class="form-control" required v-model="gender" placeholder="sexe">
          <datalist id="gender">
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
          </datalist>
        </span>
        <span v-if="categorie == 'Joueur'" class="col-md-3">
          <input list="catJoueur" type="text" class="form-control" required v-model="categorie_joueur" placeholder="categorie du joueur">
          <datalist id="catJoueur">
            <option value="U8">U8</option>
            <option value="U10">U10</option>
            <option value="U12">U12</option>
            <option value="U14">U14</option>
          </datalist>
        </span>
      </div>

      <!-- list of users -->
      <span v-for="user in getFilteredUsers" class="col-md-4">
        <div class="userStyle row">
          <div class="col-md-4">
            <img v-if="user.gender == 'Homme'" src="male.jpg" height="80px" style="border-radius: 50%">
            <img v-else src="female.jpg" height="80px" style="border-radius: 50%">
          </div>
          <div class="col-md-8">
            <small><b>Nom</b>  @{{user.name}}</small><br>
            <small><b>Cat</b>  @{{user.categorie}}</small><br>
            <small><b>Mat</b>  @{{user.matricule}}</small><br>
            <small><b>Ema</b>  @{{user.email}}</small><br>
          </div>
          <div class="row col-md-8 offset-md-4" style="margin-top: 10px">
            <a :href="'userhome/' + user.id" class="btn btn-light btn-sm" style="border-radius: 20px; width: 96px; margin-right: 6px">Plus d'info</a>
             @if(Auth::user()->categorie == 'Admin')
            <button @click="deleteUser(user)" class="btn btn-danger btn-sm" style="background: none; color: #f03e4e ;border-radius: 20px; width: 96px">Supprimer</button>
            @endif
          </div>
        </div>
      </span>
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
      'users' => $users,
    ]) !!};
</script>

<script>
  
    var app = new Vue({
      el : '#app',
      data :{
        gender: '',
        categorie: '',
        categorie_joueur: '',
        users: [],
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
        

        deleteUser(user){
          axios.delete(window.Laravel.url+"/deleteuser/"+user.id)
          .then(response =>{
            this.users = response.data.users;  
          })
          .then(error =>{
            console.log(error);
          })
        },
       

      },

      created:function(){
        this.users = window.Laravel.users;
      },

    });


</script>

@endsection
