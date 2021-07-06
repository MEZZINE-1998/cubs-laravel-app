@extends('layouts.app')

@section('content')


<div id="app" class="container" style="margin-top: 20px">
    <div class="main-body">
          <div class="row gutters-sm canvas_div_pdf">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="{{ asset('storage/'.$cv->image) }}" alt="Admin" class="rounded-circle imgShape" width="150">
                    <div class="mt-3">
                      <h4>{{ $cv->name }}</h4>
                      <b style="color: black">{{ $cv->titre }}</b><br>
                      <small class="text-muted font-size-sm">{{ $cv->description }}</small>
                    </div>
                    @if(Auth::user()->id == $cv->id || Auth::user()->post == "admin")
                    <div>
                      <br>
                      <a href="{{url('cvs/'.$cv->id.'/edit')}}" style="color: green">Update profile !</a>
                    </div>
                    <br>

                    <i v-if="notif == 0" @click="notif = 1" style="color: red; cursor: pointer;" class="fas fa-bell notification"></i>
                    <i v-if="notif == 1" @click="notif = 0" style="color: grey; cursor: pointer;" class="fas fa-bell notification"></i>

                    @endif

                    @if(Auth::user()->post == "Entreprise")
                    <br>
                    <div class="">
                       <button v-if="ing.add_to_cart == 0" @click="addtocart(ing)" class="btn btn-success btn-sm">Select</button>
                       <button v-if="ing.add_to_cart == 1" @click="deletefromcart(ing)" class="btn btn-danger btn-sm">Unselect</button>
                       <button style="margin-left: 10px" @click="DownloadPDF(ing)" class="btn btn-sm btn-success">Download PDF</button>
                    </div>
                    <br>
                    @endif

                    <!-- hidden notifications  -->

                    <span v-if="notif == 1" v-for="Recrutement in Recrutements" class="text-left">
                      <span v-for="condidat in Recrutement.id_condidats">
                        <a v-if="condidat.id == iding && Recrutement.valide == 0"><hr>
                         <span>Interview with <b>@{{ Recrutement.nom_entreprise }}</b> for <b>@{{ Recrutement.post }}</b> position</span><br>
                         <small>@{{ Recrutement.description }}</small>
                         <br>
                         <small>
                          <span v-for="x in Recrutement.id_condidats">
                            <span v-if="x.id == ing.id">
                              interview date : @{{ x.date_entretien }}<br>
                            </span>
                          </span>
                          time : @{{ Recrutement.duree_entretien }}
                        </small>
                        </a>

                        <a v-if="condidat.id == iding && Recrutement.valide == 1"><hr>
                         <b style="color: green">Congratulations !!!!!</b><br>
                         <small>Your interview with <b>@{{ Recrutement.nom_entreprise }}</b> has been <b>validated</b> for @{{ Recrutement.post }} position</small>
                        </a>
                      </span>
                    </span>


                  </div>
                </div>
              </div>


              <!-- contacts -->

              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  @if(Auth::user()->post !== "Ingenieur")
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Rate</h6>
                    <span class="text-secondary">{{ $cv->tarif }}<b> €/day</b></span>
                  </li>
                  @endif
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Email</h6>
                    <span class="text-secondary">{{ $cv->email }}</span>
                  </li>
                  @if(Auth::user()->post !== "Ingenieur")
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Phone</h6>
                    <span class="text-secondary">{{ $cv->telephone }}</span>
                  </li>
                  @endif
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Address</h6>
                    <span class="text-secondary">{{ $cv->adresse }}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Age</h6>
                    <span class="text-secondary">{{ $cv->age }}</span>
                  </li>
                </ul>
              </div>

            </div>

            <div class="col-md-8">

              <!-- dispo -->

              @if(Auth::user()->post == "admin")
              <br>              
              <div v-if="ing.dispo == 0" class="row">
                <div class="col-md-6">
                  <h6 style="color: red; margin-left: 10px"><i style="margin-right: 6px" class="fas fa-circle"></i>Not available</h6>
                </div>
                <div class="col-md-6 text-right">
                 <span @click="make_Ing_Available(ing)" style="margin-right: 10px" class="btn btn-success btn-sm">Available</span>
                </div>
              </div>
              <div v-else>
                <div class="col-md-6">
                  <h6 style="color: green; margin-left: 10px"><i style="margin-right: 6px" class="fas fa-circle"></i>Available</h6>
                </div>
              </div>
              <br>
              @endif

              
              <div id="content">

              <!-- experiences -->

              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <h5>Experience</h5>
                    </div>
                    @if(Auth::user()->id == $cv->id)
                    <div class="col-md-6 text-right">
                      <i class="fa fa-plus-square" v-if="open == 0" @click="open = 1"></i>
                      <i class="fa fa-chevron-circle-up" v-if="open == 1" @click="open = 0"></i>
                    </div>
                    @endif
                  </div>

                  <div v-if="open == 1">
                    <form>
                      {{ csrf_field() }}
                      <li  class="list-group-item">
                        <div class="form-group ">
                          <label for="">Title</label>
                          <input type="text" required="required"   class="form-control" v-model="experience.titre">
                        </div>

                        <div class="form-group">
                          <label for="">Description</label>
                          <textarea  class="form-control" required="required"  v-model="experience.commentaire"></textarea>
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                             <label for="">Company</label>
                             <input type="text" required="required" class="form-control"  v-model="experience.ville">
                           </div>
                        
                           <div class="col-md-4">
                             <label for="">Start date</label>
                             <input type="Date" required="required" class="form-control"  v-model="experience.debut">
                           </div>
                        
                        
                           <div class="col-md-4">
                             <label for="">End date</label>
                             <input type="Date" required="required" class="form-control" v-model="experience.fin">
                           </div>
                        </div>

                        <!-- errors info -->

                        <p v-if="errorsExp.length">
                          <ul>
                            <li style="color: red" v-for="error in errorsExp">@{{ error }}</li>
                          </ul>
                        </p>


                        <div class="form-group">
                          <span v-if="edit==1" class="form-control btn btn-danger btn-sm" @click="editExperience">Update</span>
                          <span v-else class="form-control btn btn-primary btn-sm" @click="addExperience">Add</span>
                        </div>
                      </li>
                    </form>
                  </div>

                  <dev v-for="experience in experiences">
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                         <b>@{{ experience.titre }}</b><br>
                         @{{ experience.commentaire }}
                         <small><br>Company : @{{ experience.ville }}<br>@{{ experience.debut }}  -  @{{ experience.fin }}</small>
                         @if(Auth::user()->id == $cv->id)
                         <span @click="deleteExperience(experience)" style="float: right;font-size: 15px;color: red"><i class="fas fa-trash-alt"></i></span>
                        <span @click="edit_tmp_Experience(experience)" style="font-size: 15px;margin-right: 8px;float: right;" ><i class="fas fa-edit"></i></span>
                        @endif
                      </div>
                    </div>
                  </dev>

                </div>
              </div>


              <!-- formations -->

              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <h5>Education</h5>
                    </div>
                    @if(Auth::user()->id == $cv->id)
                    <div class="col-md-6 text-right">
                      <i class="fa fa-plus-square" v-if="openformation == 0" @click="openformation = 1"></i>
                      <i class="fa fa-chevron-circle-up" v-if="openformation == 1" @click="openformation = 0"></i>
                    </div>
                    @endif
                  </div>
                  
                  <div v-if="openformation == 1">
                     <form>
                      {{ csrf_field() }}

                      <i style="float: right;size: 30px" class="fas fa-chevron-up"></i>
                      <li  class="list-group-item">
                        <div class="form-group ">
                          <label for="">Title</label>
                          <input type="text" required="required"  class="form-control" v-model="formation.titref">
                          
                        </div>

                        <div class="form-group">
                          <label for="">Description</label>
                          <textarea  class="form-control" required="required" v-model="formation.commentairef"></textarea>
                        
                        </div>
                        <div class="row">
                            

                               <div class="col-md-4">
                                 <label for="">School</label>
                                 <input type="text"  class="form-control" required="required" v-model="formation.villef">
                               </div>
                            
                               <div class="col-md-4">
                                 <label for="">Start date</label>
                                 <input type="Date"  class="form-control" required="required" v-model="formation.debutf">
                               </div>
                            
                            
                               <div class="col-md-4">
                                 <label for="">End Date</label>
                                 <input type="Date" class="form-control" required="required" v-model="formation.finf">
                               </div>
                        </div>

                        <!-- errors -->
                        
                        <p v-if="errorsFor.length">
                          <ul>
                            <li style="color: red" v-for="error in errorsFor">@{{ error }}</li>
                          </ul>
                        </p>


                        <div class="form-group">
                          <span v-if="editformation == 1" class="form-control btn btn-danger btn-sm" @click="editFormation">Update</span>
                          <span v-else class="form-control btn btn-primary btn-sm" @click="addFormation">Add</span>
                        </div>
                      </li>
                    </form>
                  </div>

                  <dev v-for="formation in formations">
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                         <b>@{{ formation.titref }}</b><br>
                         @{{ formation.commentairef }}
                         <small><br>School : @{{ formation.villef }}<br>@{{ formation.debutf }}  -  @{{ formation.finf }}</small>
                         @if(Auth::user()->id == $cv->id)
                         <span @click="deleteFormation(formation)" style="float: right;font-size: 15px;color: red"><i class="fas fa-trash-alt"></i></span>
                        <span @click="edit_tmp_Formation(formation)" style="font-size: 15px;margin-right: 8px;float: right;" ><i class="fas fa-edit"></i></span>
                        @endif
                      </div>
                    </div>
                  </dev>


                </div>
              </div>


              <!-- Certificats -->

              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <h5>Licenses & certifications</h5>
                    </div>
                    @if(Auth::user()->id == $cv->id)
                    <div class="col-md-6 text-right">
                      <i class="fa fa-plus-square" v-if="opencertif == 0" @click="opencertif = 1"></i>
                      <i class="fa fa-chevron-circle-up" v-if="opencertif == 1" @click="opencertif = 0"></i>
                    </div>
                    @endif
                  </div>
                  
                  <div v-if="opencertif == 1">
                     <form>
                      {{ csrf_field() }}

                      <i style="float: right;size: 30px" class="fas fa-chevron-up"></i>
                      <li  class="list-group-item">
                        <div class="form-group ">
                          <label for="">Title</label>
                          <input type="text" required="required"  class="form-control" v-model="certif.titrec">
                          
                        </div>

                        <div class="form-group">
                          <label for="">Description</label>
                          <textarea  class="form-control" required="required" v-model="certif.commentairec"></textarea>
                        
                        </div>
                        <div class="row">
                            

                               <div class="col-md-4">
                                 <label for="">Organizaton</label>
                                 <input type="text"  class="form-control" required="required" v-model="certif.villec">
                               </div>
                            
                               <div class="col-md-4">
                                 <label for="">Start date</label>
                                 <input type="Date"  class="form-control" required="required" v-model="certif.debutc">
                               </div>
                            
                            
                               <div class="col-md-4">
                                 <label for="">End Date</label>
                                 <input type="Date" class="form-control" required="required" v-model="certif.finc">
                               </div>
                        </div>
                        
                        <!-- errors -->
                        
                        <p v-if="errorsCer.length">
                          <ul>
                            <li style="color: red" v-for="error in errorsCer">@{{ error }}</li>
                          </ul>
                        </p>


                        <div class="form-group">
                          <span v-if="editcertif == 1" class="form-control btn btn-danger btn-sm" @click="editCertif">Update</span>
                          <span v-else class="form-control btn btn-primary btn-sm" @click="addCertif">Add</span>
                        </div>
                      </li>
                    </form>
                  </div>

                  <dev v-for="certif in certifs">
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                         <b>@{{ certif.titrec }}</b><br>
                         @{{ certif.commentairec }}
                         <small><br>Organizaton : @{{ certif.villec }}<br>@{{ certif.debutc }}  -  @{{ certif.finc }}</small>
                         @if(Auth::user()->id == $cv->id)
                         <span @click="deleteCertif(certif)" style="float: right;font-size: 15px;color: red"><i class="fas fa-trash-alt"></i></span>
                        <span @click="edit_tmp_Certif(certif)" style="font-size: 15px;margin-right: 8px;float: right;" ><i class="fas fa-edit"></i></span>
                        @endif
                      </div>
                    </div>
                  </dev>


                </div>
              </div>


              <!-- skills  -->

              <div class="card mb-3">
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-6">
                      <h5>Skills</h5>
                    </div>
                    @if(Auth::user()->id == $cv->id)
                    <div class="col-md-6 text-right">
                      <i class="fa fa-plus-square" v-if="opencompetence == 0" @click="opencompetence = 1"></i>
                      <i class="fa fa-chevron-circle-up" v-if="opencompetence == 1" @click="opencompetence = 0"></i>
                    </div>
                    @endif
                  </div>

                  <div v-if="opencompetence == 1">
                    <form>
                      {{ csrf_field() }}
                      <i style="float: right;size: 30px" class="fas fa-chevron-up"></i>
                      <li  class="list-group-item">
                    
                    <div class="form-group">
                      <label for=""></label>
                      <textarea  class="form-control" required="required" v-model="competence.commentaire"></textarea>
                    
                    </div>
                    

                    <!-- errors -->
                        
                      <p v-if="errorsSki.length">
                        <ul>
                          <li style="color: red" v-for="error in errorsSki">@{{ error }}</li>
                        </ul>
                      </p>


                    <div class="form-group">
                      <span v-if="editcompetence==1" class="form-control btn btn-danger btn-sm" @click="editCompetence">Modifier</span>
                      <span v-else class="form-control btn btn-primary btn-sm" @click="addCompetence">Ajouter</span>
                    </div>
                      </li>
                    </form>
                  </div>

                  <dev v-for="competence in competences">
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                        @{{ competence.commentaire}}
                        @if(Auth::user()->id == $cv->id)
                        <br>
                        <span @click="deleteCompetence(competence)" style="float: right;font-size: 15px;color: red"><i class="fas fa-trash-alt"></i></span>
                        <span @click="edit_tmp_Competence(competence)" style="font-size: 15px;margin-right: 8px;float: right;" ><i class="fas fa-edit"></i></span>
                        @endif
                      </div>
                    </div>
                  </dev>

                </div>
              </div>

              </div>

              
              </div>
            </div>
          </div>
        </div>
    </div>




<style type="text/css">

div{
  white-space: pre-line;
}

.imgShape {
    width:  150px;
    height: 150px;
    object-fit: cover;
}

.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}






.dropbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 300px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}

</style>

@endsection


@section('javascripts')

<script src="{{ asset('js/vue.min.js') }}"></script>
<script src="{{ asset('https://unpkg.com/axios/dist/axios.min.js') }}"></script>
<!-- <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js') }}"></script>
<script src="{{ asset('js_pdf/html2canvas.min.js') }}"></script> -->


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>




<script>
  window.Laravel ={!! json_encode([
      'csrfToken' => csrf_token(),
      'idcv' => $id,
      'url'   =>  url('/'),
      'ing' => $cv,
    ]) !!};
</script>

<script>
  
    var app = new Vue({
      el : '#app',
      data :{

        errorsExp: [],
        errorsFor: [],
        errorsCer: [],
        errorsSki: [],

        notif : '0',
        ing: window.Laravel.ing,
        theme:'1',
        open : '0',
        openformation: '0',
        opencompetence : '0',
        opencertif: '0',
        openloisir : '0',
        openlangue : '0',
        edit : '0',
        editformation: '0',
        editcertif: '0',
        editcompetence : '0',
        editloisire : '0',
        editlangue : '0',
        iding : window.Laravel.idcv,
        experiences: [],
        experience :{
          id:0,
          cv_id:window.Laravel.idcv,
          titre:'',
          commentaire:'',
          ville:'',
          debut:'',
          fin:''
        },

        EmptyExperience :{
          id:0,
          cv_id:window.Laravel.idcv,
          titre:'',
          commentaire:'',
          ville:'',
          debut:'',
          fin:''
        },

        formations: [],
        formation :{
          id:0,
          cv_id:window.Laravel.idcv,
          titref:'',
          commentairef:'',
          villef:'',
          debutf:'',
          finf:''
        },

        EmptyFormation :{
          id:0,
          cv_id:window.Laravel.idcv,
          titref:'',
          commentairef:'',
          villef:'',
          debutf:'',
          finf:''
        },

        certifs: [],
        certif :{
          id:0,
          cv_id:window.Laravel.idcv,
          titrec:'',
          commentairec:'',
          villec:'',
          debutc:'',
          finc:''
        },

        EmptyCertif :{
          id:0,
          cv_id:window.Laravel.idcv,
          titrec:'',
          commentairec:'',
          villec:'',
          debutc:'',
          finc:''
        },


        competences: [],
        competence :{
          id:0,
          cv_id:window.Laravel.idcv,
          commentaire:''
        },

        EmptyCompetence :{
          id:0,
          cv_id:window.Laravel.idcv,
          commentaire:'',
        },

        Recrutements: [],
      },
      methods:{

        DownloadPDF:function(ing) {


          var HTML_Width = $(".canvas_div_pdf").width();
          var HTML_Height = $(".canvas_div_pdf").height();
          var top_left_margin = 15;
          var PDF_Width = HTML_Width+(top_left_margin*2);
          var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
          var canvas_image_width = HTML_Width;
          var canvas_image_height = HTML_Height;
          
          var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;
          

          html2canvas($(".canvas_div_pdf")[0],{scale: 3, allowTaint:true}).then(function(canvas) {
            canvas.getContext('2d');
            
            console.log(canvas.height+"  "+canvas.width);
            
            
            var imgData = canvas.toDataURL("image/jpeg", 1.0);
            var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
              pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);
            
            
            for (var i = 1; i <= totalPDFPages; i++) { 
              pdf.addPage(PDF_Width, PDF_Height);
              pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
            }
            
              pdf.save("CV_Digiwise_"+ing.name+".pdf");
          });

            // var pdf = new jsPDF();

            // source = $('#content')[0];

            // console.log(source);

            // pdf.setFont("helvetica");
            // pdf.setFontSize(10);

            // pdf.text(15, 20, 'name : '+ing.name);
            // pdf.text(15, 25, 'Email : '+ing.email);
            // pdf.text(15, 30, 'Phone : '+ing.telephone);
            // pdf.text(15, 35, 'Address : '+ing.adresse);
            // pdf.text(15, 40, 'Age : '+ing.age);
            // pdf.text(15, 45, 'Rate : '+ing.tarif);


            // specialElementHandlers = {
            //     '#bypassme': function (element, renderer) {
            //         return true
            //     }
            // };
            // margins = {
            //     top: 55,
            //     bottom: 15,
            //     left: 15,
            //     width: 170,
            // };

            // pdf.fromHTML(
            //     source, // HTML string or DOM elem ref.
            //     margins.left, // x coord
            //     margins.top, 
            //     { // y coord
            //         'width': margins.width, // max width of content on PDF
            //         'elementHandlers': specialElementHandlers
            //     },

            //     function (dispose) {
            //         pdf.save('CV_DIGIWISE_'+ing.name+'.pdf');
            //     }, 
            //     margins = {
            //       top: 0,
            //       bottom: 15,
            //       left: 15,
            //       width: 170,
            //     },
            // );
        },

        deleteExperience:function(experience){
          axios.delete(window.Laravel.url+"/deleteexperience/"+experience.id)
          .then(response =>{
            this.experiences = response.data.experiences;  
          })
          .then(error =>{
            console.log(error);
          })
        },
        deleteFormation:function(formation){
          axios.delete(window.Laravel.url+"/deleteformation/"+formation.id)
          .then(response =>{
            this.formations = response.data.formations;
          })
          .then(error =>{
            console.log(error);
          })
        },

        deleteCertif:function(certif){
          axios.delete(window.Laravel.url+"/deletecertif/"+certif.id)
          .then(response =>{
            this.certifs = response.data.certifs;
          })
          .then(error =>{
            console.log(error);
          })
        },

        deleteCompetence:function(competence){
          axios.delete(window.Laravel.url+"/deletecompetence/"+competence.id)
          .then(response =>{
            this.competences = response.data.competences;
          })
          .then(error =>{
            console.log(error);
          })
        },




        
        edit_tmp_Experience:function(experience){
          this.open = 1;
          this.edit = 1;
          this.experience = experience;
        },
        editExperience: function(){
          axios.put(window.Laravel.url+"/editexperience",this.experience)
          .then(response =>{
            this.experiences = response.data.experiences;
            this.open = 0;
            this.edit = 0;
            this.experience = this.EmptyExperience;
          })
        },

        edit_tmp_Competence:function(competence){
          this.opencompetence = 1;
          this.editcompetence = 1;
          this.competence = competence;
        },
        editCompetence: function(){
          axios.put(window.Laravel.url+"/editcompetence",this.competence)
          .then(response =>{
            this.competences = response.data.competences;
            this.opencompetence = 0;
            this.editcompetence = 0;
            this.competence = this.EmptyCompetence;
          })
        },

        edit_tmp_Formation:function(formation){
          this.openformation = 1;
          this.editformation = 1;
          this.formation = formation;
        },
        editFormation: function(){
          axios.put(window.Laravel.url+"/editformation",this.formation)
          .then(response =>{
            this.formations = response.data.formations;
            this.openformation = 0;
            this.editformation = 0;
            this.formation = this.EmptyFormation;
          })
        },

        edit_tmp_Certif:function(certif){
          this.opencertif = 1;
          this.editcertif = 1;
          this.certif = certif;
        },
        editCertif: function(){
          axios.put(window.Laravel.url+"/editcertif",this.certif)
          .then(response =>{
            this.certifs = response.data.certifs;
            this.opencertif = 0;
            this.editcertif = 0;
            this.certif = this.EmptyCertif;
          })
        },



        

        addExperience: function(){
          this.errorsExp = [];
          if (!this.experience.titre) {
            this.errorsExp.push("title required.");
          }
          if (!this.experience.commentaire) {
            this.errorsExp.push("description required.");
          }
          if (!this.experience.ville) {
            this.errorsExp.push("company required.");
          }

          if (this.experience.titre && this.experience.commentaire && this.experience.ville){
            axios.post(window.Laravel.url+"/addexperience",this.experience)
            .then(response =>{
              this.experience.id = response.data.ide;
              this.experiences = response.data.experiences;
              this.experience = this.EmptyExperience;
            }) 
          } 
        },
        addFormation: function(){

          this.errorsFor = [];
          if (!this.formation.titref) {
            this.errorsFor.push("title required.");
          }
          if (!this.formation.commentairef) {
            this.errorsFor.push("description required.");
          }
          if (!this.formation.villef) {
            this.errorsFor.push("school name required.");
          }

          if (this.formation.titref && this.formation.commentairef && this.formation.villef) {
            axios.post(window.Laravel.url+"/addformation",this.formation)
            .then(response =>{
              this.formation.id = response.data.idf;
              this.formations = response.data.formations;
              this.formation = this.EmptyFormation;
            })
          } 
        },

        addCertif: function(){

          this.errorsCer = [];
          if (!this.certif.titrec) {
            this.errorsCer.push("title required.");
          }
          if (!this.certif.commentairec) {
            this.errorsCer.push("description required.");
          }
          if (!this.certif.villec) {
            this.errorsCer.push("organization name required.");
          }

          if (this.certif.titrec && this.certif.commentairec && this.certif.villec){
            axios.post(window.Laravel.url+"/addcertif",this.certif)
            .then(response =>{
              this.certif.id = response.data.idc;
              this.certifs = response.data.certifs;
              this.certif = this.EmptyCertif;
            })
          }

        },

        addCompetence: function(){
          this.errorsSki = [];
          if (!this.competence.commentaire) {
            this.errorsSki.push("title required.");
          }
          else{
            axios.post(window.Laravel.url+"/addcompetence",this.competence)
            .then(response =>{
              this.competence.id = response.data.idc;
              this.competences = response.data.competences;
              this.competence = this.EmptyCompetence;
            })
          } 
        },


        getExperience: function(){
          axios.get(window.Laravel.url+"/getexperience/"+window.Laravel.idcv)
          .then(response => {
            this.experiences = response.data;
          })
          .catch(error => {
            console.log('errors: ',error);
          })
        },
        getFormation: function(){
          axios.get(window.Laravel.url+"/getformation/"+window.Laravel.idcv)
          .then(response => {
            this.formations = response.data;
          })
          .catch(error => {
            console.log('errors: ',error);
          })
        },
        getCertif: function(){
          axios.get(window.Laravel.url+"/getcertif/"+window.Laravel.idcv)
          .then(response => {
            this.certifs = response.data;
          })
          .catch(error => {
            console.log('errors: ',error);
          })
        },
        getCompetence: function(){
          axios.get(window.Laravel.url+"/getcompetence/"+window.Laravel.idcv)
          .then(response => {
            this.competences = response.data;
          })
          .catch(error => {
            console.log('errors: ',error);
          })
        },





        getRecrutement: function(){
          axios.get(window.Laravel.url+"/getRecrutementIngenieur/"+window.Laravel.idcv)
          .then(response => {
            this.Recrutements = response.data;
            console.log(response.data);
          })
          .catch(error => {
            console.log('errors: ',error);
          })
        },


        addtocart(ing){
          axios.post(window.Laravel.url+'/addtocart',ing)
          .then(res => {
            console.log(res.data.ing);
            this.ing = res.data.ing;
          })
        },

        deletefromcart(ing){
          axios.post(window.Laravel.url+'/deletefromcart',ing)
          .then(res => {
            console.log(res.data.ing);
            this.ing = res.data.ing;
          })
        },

        make_Ing_Available(ing){
          axios.post(window.Laravel.url+'/makeIngAvailable',ing)
          .then(res => {
            console.log(res.data.ing);
            this.ing = res.data.ing;
          })
        },


      },
      created:function(){
        this.getExperience();
        this.getFormation();
        this.getCertif();
        this.getCompetence();
        this.getRecrutement();
      },

    });


</script>

@endsection
