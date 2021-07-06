@extends('layouts.app')

@section('content')

<div id="app" class="container" style="margin-top: 40px">
 	<div class="row">
    <div class="col-md-12">
      <div class="">
        <div class="card-body">
          <div class="row">
            <div class="col-md-10">
              <h5><b>DIGIWISE LAB</b></h5>
              Digiwise Lab is a private cloud based on RedHat and VMware solutions, So not hesitate to make your request for existing resources and define the duration of use before sending your request.
            </div>
            <div class="col-md-2">
              <div class="text-right">
                <button v-if="createRequest == 0" @click="createRequest = 1" class="btn btn-success btn-sm">New Request</button>
                <button v-if="createRequest == 1" @click="createRequest = 0" class="btn btn-warning btn-sm">hide Request</button>
              </div>
            </div>
          </div>
          <br>
        </div>
      </div>
    </div>
	</div>


  <!-- validation message -->

  <div style="margin-top: 15px; margin-bottom: 20px" v-if="validation">
    <div class="success-me">
      Your Lab request has been successfully received and it will be processed as soon as possible.<br>
    </div>
  </div>


  <div  v-if="createRequest == 1" class="row" style="margin-bottom: 20px">
    <div class="col-md-9">
      <div class="card">
        <div class="card-body" style="padding-bottom: 0px">
            <form>

              <div style="margin-top: 10px">
                <label for=""><b>Lab name</b></label>
                <input type="text" required="required" class="form-control" v-model="lab.name" placeholder="Lab name">
              </div>

              <div style="margin-top: 10px">
                <label for="startdate"><b>Start date</b></label>
                <input id="startdate" type="date" class="form-control" v-model="lab.startdate">
              </div>
              <div style="margin-top: 10px">
                <label for="enddate"><b>End date</b></label>
                <input id="enddate" type="date" :min="lab.startdate" class="form-control" v-model="lab.enddate">
              </div>  
              <div v-if="validDate" style="margin-top: 8px">
                <b style="color: green; margin-left: 10px">@{{validDate}}</b>
              </div>            
              <br>

              <!-- technology -->
              <b>Technology</b><br>
              <div style="margin-left: 10px" class="form-check">
                <input class="form-check-input" type="radio" value="vmware" @click="lab.technologiesredhat = []" v-model="lab.technology" id="vmware" checked>
                <label class="form-check-label" for="vmware">
                  VMware
                </label>
              </div>
              <div style="margin-left: 10px" class="form-check">
                <input class="form-check-input" type="radio" value="redhat" @click="lab.technologiesvmware = []" v-model="lab.technology" id="redhat">
                <label class="form-check-label" for="redhat">
                  Red Hat
                </label>
              </div>
              <br>

              <!-- vmware -->

              <div v-if="lab.technology == 'vmware'">
                <b>VMware</b>
                <br>
                <div style="margin-left: 10px" class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Vmware Cloud Director" v-model="lab.technologiesvmware">
                  <label class="form-check-label" for="inlineCheckbox1">Vmware Cloud Director</label>
                </div>
                <br>
                <div style="margin-left: 10px" class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="vSphere Entreprise Plus" v-model="lab.technologiesvmware">
                  <label class="form-check-label" for="inlineCheckbox2">vSphere Entreprise Plus</label>
                </div>
                <br>
                <div style="margin-left: 10px" class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="vSAN Standard" v-model="lab.technologiesvmware">
                  <label class="form-check-label" for="inlineCheckbox3">vSAN Standard</label>
                </div>
                <br>
                <div style="margin-left: 10px" class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="NSX DC Advanced" v-model="lab.technologiesvmware">
                  <label class="form-check-label" for="inlineCheckbox4">NSX DC Advanced</label>
                </div>
                <br>
                <div style="margin-left: 10px" class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox5" value="tanzu" v-model="lab.technologiesvmware">
                  <label class="form-check-label" for="inlineCheckbox5">Tanzu</label>
                </div>
              </div>

              <!-- red hat -->

              <div v-else>
                <b>Red Hat</b>
                <br>
                <div style="margin-left: 10px" class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox11" value="Red Hat OpenStack" v-model="lab.technologiesredhat">
                  <label class="form-check-label" for="inlineCheckbox11">Red Hat OpenStack</label>
                </div>
                <br>
                <div style="margin-left: 10px" class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox22" value="Ansible Automation" v-model="lab.technologiesredhat">
                  <label class="form-check-label" for="inlineCheckbox22">Ansible Automation</label>
                </div>
                <br>
                <div style="margin-left: 10px" class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox33" value="Red Hat Fuse" v-model="lab.technologiesredhat">
                  <label class="form-check-label" for="inlineCheckbox33">Red Hat Fuse</label>
                </div>
                <br>
                <div style="margin-left: 10px" class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox44" value="Red Hat 3scale" v-model="lab.technologiesredhat">
                  <label class="form-check-label" for="inlineCheckbox44">Red Hat 3scale</label>
                </div>
                <br>
                <div style="margin-left: 10px" class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox55" value="Red Hat OpenShift" v-model="lab.technologiesredhat">
                  <label class="form-check-label" for="inlineCheckbox55">Red Hat OpenShift</label>
                </div>
              </div>

              <div style="margin-top: 30px" class="form-group">
                <span v-if="isntDisabled" class="form-control btn btn-primary btn-sm" style="cursor: pointer;" @click="labreservation()">
                  Send your request
                </span>
                <button v-else class="form-control btn btn-primary btn-sm" disabled>
                  Send your request
                </button>
              </div>
           
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <img style="width:  100%; object-fit: cover; border-radius: 5px" src="dPoster.png">
    </div>  

  </div> 

  

  <!-- progress bar -->
  <div style="z-index : -1;" class="card">
    <div class="card-body">
      <br>
      <ul class="progressbar">
        <li>Request</li>
        <li>Request Approuval</li>
        <li>PoPartner</li>
        <li>Confirmed & Booked</li>
        <li>Ongoing</li>
        <li>Closed</li>
      </ul>
    </div>
  </div>

  <br>
  <!-- history -->
  <div class="card">
    <div class="card-body">
      <div>
        <h6 style="color: green"><b>My Requests</b></h6>
      </div>
      <table style="margin-top: 15px" class="table">
        <thead>
          <tr>
            <th>Lab name</th>
            <th>Technology</th>
            <th>Start date</th>
            <th>End date</th>
            <th>Duration (days)</th>
            <th>created at</th>
            <th class="text-right">Current state</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="lab in labs">
            <td>@{{lab.name}}</td>
            <td>@{{lab.technologie}}</td>
            <td>@{{lab.startdate}}</td>
            <td>@{{lab.enddate}}</td>
            <td>@{{ deriod_lab(lab.startdate, lab.enddate) }}</td>
            <td>@{{ lab.created_at }}</td>
            <td class="text-right">
              <b v-if="lab.actualstate == 'ongoing'" style="color: #7ee841; padding: 3px 11px; border-radius: 13px; border: 1px solid #7ee841">@{{ lab.actualstate }}</b>
              <b v-else-if="lab.actualstate == 'closed'" style="color: #ed6647; padding: 3px 11px; border-radius: 13px; border: 1px solid #ed6647">@{{ lab.actualstate }}</b>
              <b v-else style="color: #0e0e0e; padding: 3px 11px; border-radius: 13px; border: 1px solid #0e0e0e">@{{ lab.actualstate }}</b>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>



@endsection


@section('javascripts')
<script src="{{ asset('js/vue.min.js') }}"></script>
<script src="{{ asset('https://unpkg.com/axios/dist/axios.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
  window.Laravel ={!! json_encode([
      'csrfToken' => csrf_token(),
      'AuthId' => Auth::user()->id,
      'labs' => $labs,
      'url'   =>  url('/')
    ]) !!};
</script>

<script>

    // VueJS

    var app = new Vue({
      el : '#app',
      data :{
        labs: window.Laravel.labs,
        commentaireRequest: '',
        AuthId: window.Laravel.AuthId,
        errors: [],
        validation: false,
        createRequest: '0',
        istDisabledAva: true,
        lab:{
          name: '',
          startdate: '',
          enddate: '',
          technologiesvmware: [],
          technologiesredhat: [],
          technologies: {},
          technology: 'vmware',
        },      
      },


      computed: {

        validDate(){

          if (this.lab.startdate && this.lab.enddate) {

            return "Ressources available";

            // for (var i = 0; i < this.labs.length; i++) {

            //   // for (var i = 0; i < JSON.parse(this.labs[i].technologies).length; i++) {
            //   //   console.log(JSON.parse(this.labs[i].technologies)[i]);
            //   // }


            //   if (this.labs[i].enddate > this.lab.startdate && this.lab.technology == this.labs[i].technologie) {
            //     console.log(this.labs[i].enddate);
            //     console.log(this.labs[i].technologie);
            //     this.istDisabledAva = false;
            //     return "Ressources not available";
            //   }

            // }

            // this.istDisabledAva = true;
            // return "Ressources available";
          }
        },

        isntDisabled(){
          console.log(this.lab.name);
          if (this.lab.name && this.lab.startdate && this.lab.enddate && (this.lab.technologiesredhat[0] || this.lab.technologiesvmware[0])) {
            return true;
          }
          return false;
        }
      },


      methods:{

        deriod_lab(startdate, enddate){
            var t = startdate.split(/[- :]/);
            var startdate = new Date(Date.UTC(t[0], t[1]-1, t[2]-1));

            var t = enddate.split(/[- :]/);
            var enddate = new Date(Date.UTC(t[0], t[1]-1, t[2]-1));

            var diff = enddate.getTime() - startdate.getTime();    
            var daydiff = diff / (1000 * 60 * 60 * 24); 

            return daydiff;
        },

        ongoing(created_at){

          var actual_time = new Date(); 
          var t = created_at.split(/[- :]/);
          var Tdate = new Date(Date.UTC(t[0], t[1]-1, t[2]-1, t[3]-1, t[4], t[5]));

          if(Tdate < actual_time){
            return 'ongoing';
          }
          return '';
        },


        labreservation(){

          this.validation = false;

          if (this.lab.technology == 'vmware') {
            this.lab.technologies = JSON.stringify(this.lab.technologiesvmware);
            console.log(this.lab.technologies);
          }
          else{
            this.lab.technologies = JSON.stringify(this.lab.technologiesredhat);
            console.log(this.lab.technologies);
          }


          axios.post(window.Laravel.url+"/addlab",this.lab)
          .then(response =>{
            this.lab.name = '';
            this.lab.startdate = '';
            this.lab.enddate = '';
            this.lab.technology = 'vmware';
            this.lab.technologiesredhat = [];
            this.lab.technologiesvmware = [];
            this.lab.technologies = {};
            this.validation = true;
            this.labs = response.data.labs;
            console.log(response.data.etat);
          })
          .catch(error => {
            console.log('errors ',error);
          })


          // send mails to admins and partner
          // axios.post(window.Laravel.url+"/sendlabmail",this.lab)
          // .then(response =>{
          //   console.log(response.data.etat);
          //   console.log(response.data.etat2);
          // })
          // .catch(error => {
          //   console.log('errors ',error);
          // })
        
          
        },


        // closeLab() {
        //   setTimeout(() => {

        //       // get all labs
        //       // make condition if it's the end of lab
        //       // make actualsatet = closed in database
        //       // sed email to partner
              
        //       this.closeLab()
        //   }, 1000*60*60) // each hour run the function
        // }


      },

      // created: function(){
      //   this.closeLab();
      // },


    });


</script>




@endsection