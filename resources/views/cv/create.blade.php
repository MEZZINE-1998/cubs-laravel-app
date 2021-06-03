@extends('layouts.app')

@section('content')


 <br><br>

<div class="container" id="appSubmit">
      <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10">

              <li class="list-group-item" style="background-color: #f7f7f7">
                  create new account
              </li>
              <li class="list-group-item ">
            <form action="{{ url('cvs') }}" method="post" enctype="multipart/form-data">

              {{ csrf_field() }}
                    <br>
                     
                     <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" required v-model="user.name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="post" class="col-md-4 col-form-label text-md-right">{{ __('User') }}</label>

                            <div class="col-md-6">
                                <input list="browsers" type="post" class="form-control" required v-model="user.post">
                                <datalist id="browsers">
                                  <option value="Admin">Administrator</option>
                                  <option value="Ingenieur">Engineer</option>
                                  <option value="Entreprise">Partner</option>
                                </datalist>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" required required v-model="user.email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" required v-model="user.password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" v-model="user.passwordconfirm">
                                <br><b style="color: red">@{{ message }}</b>
                            </div>
                        </div>

                        <br><br>

                    <span style="cursor: pointer;" class="form-control btn btn-primary" @click="sendNewAccount">Save</span>
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
    ]) !!};
</script>

<script>
  
    var app = new Vue({
      el : '#appSubmit',
      data :{
        message: '',
        password: '',
        passwordconfirm : '',
        user:{
          name: '',
          post: '',
          email: '',
          password : '',
          passwordconfirm: '',
        },
        userEmpty:{
          name: '',
          post: '',
          email: '',
          password : '',
          passwordconfirm: '',
        },
      },
      methods:{

        sendNewAccount() {
          
          if (this.user.password != this.user.passwordconfirm) {
            this.message = 'Unmatched passwords';
          }
          else{

            // then send user
            axios.post(window.Laravel.url+"/sendNewAccount", this.user)
              .then(response =>{
                console.log(response.data);
                this.user = this.userEmpty;
                Swal.fire(
                  '',
                  'A new account has been created',
                  'success',
                )
              })
              .then(error =>{
                console.log(error);
                this.user = this.userEmpty;
              })

            // send mail to user to update profile
            axios.post(window.Laravel.url+"/sendMaiUpdateProfile", this.user)
            .then(response =>{
              console.log("success"+response.data.email);
            })
            .catch(error => {
              console.log('errors ',error);
            })




          }
        },


      },

    });


</script>

@endsection
