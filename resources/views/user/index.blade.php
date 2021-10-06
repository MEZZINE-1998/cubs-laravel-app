@extends('layouts.app')

@section('content')


<div class="container" id="app" style="margin-top: 80px">
      <div class="row">
          <div class="col-md-4 text-center" style="background-color: white; padding: 30px; border-radius: 4px; margin-bottom: 8px; box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, .1); border-top: 5px solid #36c25b">
            <img style="border-radius: 50%; height: 160px" v-if="user.gender == 'Femme'" src="{{url('/female.jpg')}}">
            <img style="border-radius: 50%; height: 160px" v-else src="{{url('/male.jpg')}}">
            <br><br>
            <span class="row" style="margin-top: 10px">
              <b class="col-md-4 text-left">Nom </b>
              <span class="col-md-8">@{{user.name}}</span>
            </span>
            <span class="row" style="margin-top: 10px">
              <b class="col-md-4 text-left">Matricule </b>
              <span class="col-md-8">@{{user.matricule}}</span>
            </span>
            <span class="row" style="margin-top: 10px">
              <b class="col-md-4 text-left">Sexe </b>
              <span class="col-md-8">@{{user.gender}}</span>
            </span>
            <span class="row" style="margin-top: 10px">
              <b class="col-md-4 text-left">Categorie </b>
              <span class="col-md-8">@{{user.categorie}}</span>
            </span>
            <span class="row" style="margin-top: 10px" v-if="user.categorie == 'Joueur'">
              <b class="col-md-4 text-left">Cat Joueur</b>
              <span class="col-md-8">@{{user.categorie_joueur}}</span>
            </span>
            <span class="row" style="margin-top: 10px">
              <b class="col-md-4 text-left">Email </b>
              <span class="col-md-8">@{{user.email}}</span>
            </span>
            <br><br>
            <span style="cursor: pointer; box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, .1);" class="form-control btn btn-light" @click="showUpdateUser = 1">Update</span>
          </div>
          <div class="col-md-7" v-if="showUpdateUser == 1">
            <form>
              {{ csrf_field() }}
                <br>
                 <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>
                    <div class="col-md-7">
                        <input id="name" type="text" class="form-control" required v-model="user.name" autofocus>
                    </div>
                  </div>

                  <div class="form-group row">
                      <label for="matricule" class="col-md-4 col-form-label text-md-right">{{ __('Matricule') }}</label>
                      <div class="col-md-7">
                          <input id="matricule" type="text" class="form-control" required v-model="user.matricule" autofocus>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Sexe') }}</label>
                    <div class="col-md-7">
                        <input list="gender" type="text" class="form-control" required v-model="user.gender">
                        <datalist id="gender">
                          <option value="Homme">Homme</option>
                          <option value="Femme">Femme</option>
                        </datalist>

                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="categorie" class="col-md-4 col-form-label text-md-right">{{ __('Categorie') }}</label>
                    <div class="col-md-7">
                        <input list="categorie" type="text" class="form-control" required v-model="user.categorie">
                        <datalist id="categorie">
                          <option value="Admin">Admin</option>
                          <option value="Educateur">Educateur</option>
                          <option value="Joueur">Joueur</option>
                        </datalist>

                    </div>
                  </div>

                  <div v-if="user.categorie == 'Joueur'" class="form-group row">
                    <label for="catJoueur" class="col-md-4 col-form-label text-md-right">{{ __('Categorie joueur') }}</label>
                    <div class="col-md-7">
                        <input list="catJoueur" type="text" class="form-control" required v-model="user.categorie_joueur">
                        <datalist id="catJoueur">
                          <option value="U8">U8</option>
                          <option value="U10">U10</option>
                          <option value="U12">U12</option>
                          <option value="U14">U14</option>
                        </datalist>

                    </div>
                  </div>

                  <div class="form-group row">
                      <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Address E-Mail') }}</label>
                      <div class="col-md-7">
                          <input type="email" class="form-control" required required v-model="user.email">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
                      <div class="col-md-7">
                          <input type="password" class="form-control" required v-model="user.password">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                      <div class="col-md-7">
                          <input id="password-confirm" type="password" class="form-control" v-model="user.passwordconfirm">
                          <br><b style="color: red">@{{ message }}</b>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="confirm" class="col-md-4 col-form-label text-md-right"></label>
                      <div class="col-md-7">
                          <span style="cursor: pointer;" class="btn btn-success" @click="updateUser">Confirm</span>
                      </div>
                  </div>
                </form>
              </li>   
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
      'user'  =>  Auth::user(),
    ]) !!};
</script>

<script>
  
    var app = new Vue({
      el : '#app',
      data :{
        showUpdateUser: '0',
        message: '',
        password: '',
        passwordconfirm : '',
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
        userEmpty:{
          name: '',
          matricule: '',
          gender:'',
          categorie: '',
          categorie_joueur:'',
          email: '',
          password : '',
          passwordconfirm: '',
        },
      },
      methods:{

        updateUser() {

          if (!this.user.password) {
            this.message = 'password required';
          }
          else{
            if (this.user.password != this.user.passwordconfirm) {
              this.message = 'Unmatched passwords';
            }
            else{
              // then send user
              axios.post(window.Laravel.url+"/updateuser", this.user)
                .then(response =>{
                  this.user = window.Laravel.user;
                  Swal.fire(
                    '',
                    'Your account has been modified',
                    'success',
                  )
                })
                .then(error =>{
                  console.log(error);
                })
            }
          }
        },
      },

      created:function(){
        this.user = window.Laravel.user;
      },

    });


</script>

@endsection
