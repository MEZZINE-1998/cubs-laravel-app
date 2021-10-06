@extends('layouts.app')

@section('content')

  <div class="container" id="app" style="margin-top: 50px">

    <div class="row">
      

      <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-body" style="background-color: #fff; border-radius: 4px; padding: 10px; padding-top: 20px; margin-bottom: 6px; box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, .1); border-top: 5px solid #fc9330">
              {!! $calendar->calendar() !!}
            </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="row">
          <div class="col-md-8">
            <h4># Active Events</h4>
          </div>
          @if(Auth::user()->categorie != 'Joueur')
          <div class="col-md-4">
            <div class="text-right" style="margin-bottom: 20px">
              <span @click="addEvenet = 1" v-if="!addEvenet" class="btn btn-dark">New event</span>
            </div>
          </div>
          @endif
        </div>
        <!-- show active events -->
        <div v-for="event in events">
          <span v-if="valid_date(event.startdate)">
            <span class="row" style="background-color: #fff; border-radius: 4px; padding: 10px; margin-bottom: 6px; box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, .2)">
              <span class="col-md-12">
                <b>@{{event.title}} | @{{event.categorie}}</b><br>
                <small>@{{event.startdate}} - @{{event.enddate}}</small><br><br>
                <small>@{{event.description}}</small>
              </span>
              @if(Auth::user()->categorie == 'Admin')
              <span class="col-md-12 text-right" style="margin-top: 16px">
                <a href="" @click="deleteEvent(event)" class="btn btn-danger btn-sm" style="background: none; color: #f03e4e ;border-radius: 20px; width: 110px">Retirer</a>
              </span>
              @endif
            </span>
          </span>
        </div>
      </div>

      <!-- add event -->
      <div v-if="addEvenet">
        <form  class="moreInfoTestStyle">
          <span class="row">
            <h4 class="col-md-11"># new Event</h4>
            <span class="col-md-1 text-right" style="cursor: pointer;" @click="addEvenet = 0">
              <i class="fas fa-times"></i>
            </span>
          </span><br>
          {{ csrf_field() }}
          <div class="row">
            <div class="form-group">
              <label for="Title">Title:</label>
              <input type="text" class="form-control" v-model="event.title">
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <label for="categorie">categorie:</label>
              <input type="text" list="categorie" class="form-control" v-model="event.categorie">
              <datalist id="categorie">
                <option value="Match"> 
                <option value="Repos">
                <option value="Entrainement">
                <option value="Test">
                <option value="Rencontre">
              </datalist>
            </div>
          </div>
          <div v-if="event.categorie == 'Match' || event.categorie == 'Test' || event.categorie == 'Entrainement'" class="row">
            <div class="form-group col-md-6">
              <label for="sexe"> Sexe : </label>  
              <input list="sexe" class="form-control" type="text" v-model="event.sexe">
              <datalist id="sexe">
                <option value="Homme"> 
                <option value="Femme">
              </datalist>
            </div>
            <div class="form-group col-md-6">
              <label for="catjou"> categorie joueur : </label>  
              <input list="catjou" class="form-control" type="text" v-model="event.categorie_joueur">
              <datalist id="catjou">
                <option value="U8"> 
                <option value="U10">
                <option value="U12"> 
                <option value="U14">
              </datalist>
            </div>
          </div>
          <div v-if="event.categorie == 'Rencontre'" class="row">
            <div class="form-group">
              <label for="rencontre"> Joueur à rencontrer : </label>  
              <input list="rencontre" class="form-control" type="text" v-model="event.rencontre_joueur">
              <datalist id="rencontre">
                <option v-for="joueur in joueurs" :value="joueur.id">@{{joueur.name}}</option>
              </datalist>
            </div>
          </div>
          <div class="row">
             <div class="form-group col-md-6">
              <label> Start Date : </label>  
              <input class="date form-control" id="startdate"  type="datetime-local" v-model="event.startdate">   
             </div>
             <div class="form-group col-md-6">
                <label> End Date : </label>  
                <input class="date form-control" id="enddate" type="datetime-local" v-model="event.enddate">   
             </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label> Description</label>  
              <textarea class="date form-control" rows="4" v-model="event.description"></textarea>  
           </div>
          </div>
          <div class="row">
            <div class="form-group">
              <a href="" style="cursor: pointer;" class="btn btn-success" @click="addEvenetFunction">Programmer</a>
            </div>
          </div>
          <!-- errors info -->
          <p v-if="errorsEvent.length">
            <ul>
              <li style="color: red" v-for="error in errorsEvent">@{{ error }}</li>
            </ul>
          </p>
          <!-- Show calendar -->
          <div v-if="addEvenetSuccess" class="alert alert-success" role="alert">
            Event added successfully
          </div>
      </form>
    </div>
  </div>

    

</div>


@endsection

@section('javascripts')

<script src="{{ asset('js/vue.min.js') }}"></script>
<script src="{{ asset('https://unpkg.com/axios/dist/axios.min.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
{!! $calendar->script() !!}


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

        joueurs: [],

        addEvenet: 0,
        addEvenetSuccess: 0,

        currentDate: Date(),

        errorsEvent: [],
     
        events: [],
        event :{
          id:0,
          title:'',
          categorie: '',
          startdate:'',
          enddate:'',
          description: '',
          sexe: '',
          categorie_joueur: '',
          rencontre_joueur: '',
        },

        emptyEvent :{
          id:0,
          title:'',
          categorie: '',
          startdate:'',
          enddate:'',
          description:'',
          sexe: '',
          categorie_joueur: '',
          rencontre_joueur: '',
        },

      },
      methods:{        

        valid_date(date){

          // send notification to Entreprise --> missing validation condidats.
          var actual_time = new Date(); 
          var t = date.split(/[- :]/);
          var date_after = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3]-1, t[4], t[5]));

          console.log(date);
          console.log(date_after);

          if(date_after > actual_time){
            return 1;
          }
          return 0;
        },


        addEvenetFunction: function(){
          this.errorsEvent = [];
          if (!this.event.title) {
            this.errorsEvent.push("title required.");
          }
          if (!this.event.categorie) {
            this.errorsEvent.push("Categorie required.");
          }
          if (!this.event.startdate) {
            this.errorsEvent.push("start date required.");
          }
          if (!this.event.enddate) {
            this.errorsEvent.push("end date required.");
          }

          if (this.event.title && this.event.startdate && this.event.enddate && this.event.categorie){
            axios.post(window.Laravel.url+"/event/add",this.event)
            .then(response =>{
              this.addEvenetSuccess = 1;
              this.events = response.data.events;
              this.event = this.emptyEvent;
              console.log(response.data);
            }) 
          } 
        },


        // edit_tmp_Experience:function(experience){
        //   this.open = 1;
        //   this.edit = 1;
        //   this.experience = experience;
        // },
        // editExperience: function(){
        //   axios.put(window.Laravel.url+"/editexperience",this.experience)
        //   .then(response =>{
        //     this.experiences = response.data.experiences;
        //     this.open = 0;
        //     this.edit = 0;
        //     this.experience = this.EmptyExperience;
        //   })
        // },


        getEvents: function(){
          axios.get(window.Laravel.url+"/getevents")
          .then(response => {
            this.events = response.data;
            console.log(this.events);
          })
          .catch(error => {
            console.log('errors: ',error);
          })
        },


        deleteEvent:function(event){
          axios.delete(window.Laravel.url+"/deleteevent/"+event.id)
          .then(response =>{
            this.events = response.data.events;  
          })
          .then(error =>{
            console.log(error);
          })
        },

        getJoueurs: function(){
          axios.get(window.Laravel.url+"/getjoueurs")
          .then(response => {
            this.joueurs = response.data;
          })
          .catch(error => {
            console.log('errors: ',error);
          })
        },

       },
      
      created:function(){
        this.getEvents();
        this.getJoueurs();
      },

    });


</script>

@endsection




