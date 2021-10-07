@extends('layouts.app')

@section('content')


<div class="container" id="app" style="margin-top: 60px">
      <div v-if="newtest == 0">
        <div class="row" style="margin-bottom: 20px">
          <div class="col-md-6">
          <h4># All tests</h4>
        </div>
        <div class="col-md-5 text-right">
          <span @click="newtest = 1" class="btn btn-dark" style="cursor: pointer;"><b>Nouveau test</b></span>
        </div>
        </div>
        <span v-for="test in tests" class="row">
          <span class="col-md-11 row" style="background-color: white; padding: 20px; border-radius: 4px; margin-bottom: 8px; box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, .1)">
            <div class="col-md-2">
              <img v-if="filterUserFromIdJoueur(test.id_joueur).gender == 'Homme'" src="male.jpg" height="70px" style="border-radius: 60%">
              <img v-else src="female.jpg" height="70px" style="border-radius: 60%">
            </div>
            <div class="col-md-4">
              <b>Date @{{test.date}}</b><br>
              <a :href="'userhome/' + filterUserFromIdJoueur(test.id_joueur).id">@{{filterUserFromIdJoueur(test.id_joueur).name}} | @{{filterUserFromIdJoueur(test.id_joueur).matricule}}</a><br>
              <span>@{{filterUserFromIdJoueur(test.id_joueur).categorie_joueur}}</span>
            </div>
            <small class="col-md-4">
              Qualités mentales  <b>@{{moyenne(JSON.parse(test.test).first_critere)}} / 20</b><br>
              Habiletés Techniques  <b>@{{moyenne(JSON.parse(test.test).sec_critere)}} / 20</b><br>
              Habiletés Tactiques  <b>@{{moyenne(JSON.parse(test.test).thi_critere)}} / 20</b><br>
              Qualités physiques  <b>@{{moyenne(JSON.parse(test.test).fou_critere)}} / 20</b>
            </small>
            <small class="col-md-2">
              <button @click="testMoreInfoTestFunction(test)" class="btn btn-light btn-sm" style="border-radius: 20px; width: 110px; margin-bottom: 10px">Plus d'info</button>
              <button @click="deleteTest(test)" class="btn btn-danger btn-sm" style="background: none; color: #f03e4e ;border-radius: 20px; width: 110px">Supprimer</button>
            </small>
          </span>
        </span>
        <div v-if="moreInfoTest != 0">
          <span class="moreInfoTestStyle">
            <div class="row text-right">
              <span style="cursor: pointer;" @click="moreInfoTest = 0"><i class="fas fa-times"></i></span>
            </div>
            <span class="col-md-12 row" style="background-color: white; padding: 20px; border-radius: 4px; margin-bottom: 8px">
              <div class="col-md-2">
                <img v-if="filterUserFromIdJoueur(testMoreInfo.id_joueur).gender == 'Homme'" src="male.jpg" height="70px" style="border-radius: 60%">
                <img v-else src="female.jpg" height="70px" style="border-radius: 60%">
              </div>
              <div class="col-md-4">
                <b>Date @{{testMoreInfo.date}}</b><br>
                <span>@{{filterUserFromIdJoueur(testMoreInfo.id_joueur).name}} | @{{filterUserFromIdJoueur(testMoreInfo.id_joueur).matricule}}</span><br>
                <span>@{{filterUserFromIdJoueur(testMoreInfo.id_joueur).categorie_joueur}}</span>
              </div>
              <small class="col-md-4">
                Qualités mentales  <b>@{{moyenne(JSON.parse(testMoreInfo.test).first_critere)}} / 20</b><br>
                Habiletés Techniques  <b>@{{moyenne(JSON.parse(testMoreInfo.test).sec_critere)}} / 20</b><br>
                Habiletés Tactiques  <b>@{{moyenne(JSON.parse(testMoreInfo.test).thi_critere)}} / 20</b><br>
                Qualités physiques  <b>@{{moyenne(JSON.parse(testMoreInfo.test).fou_critere)}} / 20</b>
              </small>
              <small class="col-md-2">
                <button @click="deleteTest(testMoreInfo)" class="btn btn-danger btn-sm" style="background: none; color: #f03e4e ;border-radius: 20px; width: 110px">Supprimer</button>
              </small>
            </span>
            <hr>
            <div class="row">
              <div class="col-md-3">
                <h6>## Qualités mentales </h6>
                <span v-for="sc in JSON.parse(testMoreInfo.test).first_critere.sous_criteres">
                  <b># @{{sc.titre}} :</b><br>
                  <span v-for="note in sc.notes">
                    <small>@{{note.titre}} @{{note.note1}}</small><br>
                  </span>
                </span>
              </div>
              <div class="col-md-3">
                <h6>## Habiletés Techniques </h6>
                <span v-for="sc in JSON.parse(testMoreInfo.test).sec_critere.sous_criteres">
                  <b># @{{sc.titre}} :</b><br>
                  <span v-for="note in sc.notes">
                    <small>@{{note.titre}} @{{note.note1}}</small><br>
                  </span>
                </span>
              </div>
              <div class="col-md-3">
                <h6>## Habiletés Tactiques </h6>
                <span v-for="sc in JSON.parse(testMoreInfo.test).thi_critere.sous_criteres">
                  <b># @{{sc.titre}} :</b><br>
                  <span v-for="note in sc.notes">
                    <small>@{{note.titre}} @{{note.note1}}</small><br>
                  </span>
                </span>
              </div>
              <div class="col-md-3">
                <h6>## Qualités physiques </h6>
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

      <div v-if="newtest == 1" class="row">
          <div class="col-md-11 row" style="margin-bottom: 15px">
            <div class="col-md-6">
              <h4># New test</h4>
            </div>
            <div class="col-md-6 text-right">
              <span @click="newtest = 0" class="btn btn-dark" style="cursor: pointer;"><i style="margin-right: 7px" class="fas fa-arrow-left"></i><b>Retour</b></span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="text-center" style="background-color: #fff; border-radius: 4px; padding: 30px; box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, .1); border-top: 5px solid #fc9330">
              <div class="row" style="margin-bottom: 15px">
                <div class="col-md-6">
                  <input placeholder="sexe" list="gender" type="text" class="form-control" required v-model="gender">
                  <datalist id="gender">
                    <option note="Homme">Homme</option>
                    <option note="Femme">Femme</option>
                  </datalist>
                </div>
                <div class="col-md-6">
                  <input placeholder="categorie" list="catJoueur" type="text" class="form-control" required v-model="categorie_joueur">
                  <datalist id="catJoueur">
                    <option note="U8">U8</option>
                    <option note="U10">U10</option>
                    <option note="U12">U12</option>
                    <option note="U14">U14</option>
                  </datalist>
                </div>
              </div>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Avatar</th>
                    <th class="text-left" scope="col">name</th>
                    <th class="text-left" scope="col">matricule</th>
                    <th scope="col" class="text-right"></th>
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
                      <input class="form-check-input" type="radio" :id="user.id" :value="user.id" v-model="test.id_joueur">
                    </th>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-5">
              <div style="padding: 10px 0px">
                <!-- first part du test -->
                <span class="card" style="margin-bottom: 10px">
                  <span @click="show.first_critere = !show.first_critere" class="card-header">@{{test.first_critere.titre}} 
                    <i v-if="show.first_critere == 0" style="float: right; padding-top: 4px; cursor: pointer" class="fas fa-chevron-down"></i>
                    <i v-else style="float: right; padding-top: 4px; cursor: pointer" class="fas fa-chevron-up"></i>
                  </span>
                  <span v-if="show.first_critere == 1" class="card-body">
                    <span v-for="sous_critere in test.first_critere.sous_criteres">
                      <br>
                      <b>@{{sous_critere.titre}}</b>
                      <hr>
                      <div v-for="note in sous_critere.notes" class="form-group row">
                        <label class="col-md-8 col-form-label">@{{note.titre}}</label>
                        <div class="col-md-4">
                            <input type="number" step="0.1" class="form-control" v-model="note.note1">
                        </div>
                      </div>
                    </span>
                  </span>
                </span>

                <!-- second part du test -->
                <span class="card" style="margin-bottom: 10px">
                  <span @click="show.sec_critere = !show.sec_critere" class="card-header">@{{test.sec_critere.titre}} 
                    <i v-if="show.sec_critere == 0" style="float: right; padding-top: 4px; cursor: pointer" class="fas fa-chevron-down"></i>
                    <i v-else style="float: right; padding-top: 4px; cursor: pointer" class="fas fa-chevron-up"></i>
                  </span>
                  <span v-if="show.sec_critere == 1" class="card-body">
                    <span v-for="sous_critere in test.sec_critere.sous_criteres">
                      <br>
                      <b>@{{sous_critere.titre}}</b>
                      <hr>
                      <div v-for="note in sous_critere.notes" class="form-group row">
                        <label class="col-md-8 col-form-label">@{{note.titre}}</label>
                        <div class="col-md-4">
                            <input type="number" step="0.1" class="form-control" v-model="note.note1">
                        </div>
                      </div>
                    </span>
                  </span>
                </span>

                <!-- third part du test -->
                <span class="card" style="margin-bottom: 10px">
                  <span @click="show.thi_critere = !show.thi_critere" class="card-header">@{{test.thi_critere.titre}} 
                    <i v-if="show.thi_critere == 0" style="float: right; padding-top: 4px; cursor: pointer" class="fas fa-chevron-down"></i>
                    <i v-else style="float: right; padding-top: 4px; cursor: pointer" class="fas fa-chevron-up"></i>
                  </span>
                  <span v-if="show.thi_critere == 1" class="card-body">
                    <span v-for="sous_critere in test.thi_critere.sous_criteres">
                      <b>@{{sous_critere.titre}}</b>
                      <hr>
                      <div v-for="note in sous_critere.notes" class="form-group row">
                        <label class="col-md-8 col-form-label">@{{note.titre}}</label>
                        <div class="col-md-4">
                            <input type="number" step="0.1" class="form-control" v-model="note.note1">
                        </div>
                      </div>
                    </span>
                  </span>
                </span>


                <!-- fourth part du test -->
                <span class="card" style="margin-bottom: 10px">
                  <span @click="show.fou_critere = !show.fou_critere" class="card-header">@{{test.fou_critere.titre}} 
                    <i v-if="show.fou_critere == 0" style="float: right; padding-top: 4px; cursor: pointer" class="fas fa-chevron-down"></i>
                    <i v-else style="float: right; padding-top: 4px; cursor: pointer" class="fas fa-chevron-up"></i>
                  </span>
                  <span v-if="show.fou_critere == 1" class="card-body">
                    <span v-for="sous_critere in test.fou_critere.sous_criteres">
                      <b>@{{sous_critere.titre}}</b>
                      <hr>
                      <div v-for="note in sous_critere.notes" class="form-group row">
                        <label class="col-md-8 col-form-label">@{{note.titre}}</label>
                        <div class="col-md-4">
                            <input type="number" step="0.1" class="form-control" v-model="note.note1">
                        </div>
                      </div>
                    </span>
                  </span>
                </span>

                <div v-if="test.id_joueur" class="text-left">
                  <a class="btn btn-warning text-left" @click="addTest">Save test</a>
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

        moreInfoTest: '0',

        users: [],
        gender: '',
        categorie_joueur: '',

        show:{
          first_critere: '0',
          sec_critere: '0',
          thi_critere: '0',
          fou_critere: '0',
        },

        newtest: '0',

        test:{
          id_joueur : '',

          first_critere: {
            titre: 'Qualités mentales',
            sous_criteres:[
              {
                titre: 'Etat d`esprit',
                notes: [
                  {
                    titre: 'Confiance en soi ',
                    note1: '0',
                    commentaire: "Joueur bien dans sa peau et dans sa tête"
                  },
                  {
                      titre: 'Goût de l`effort ',
                      note1: '0',
                      commentaire: "Bonne capacité à répéter les efforts."
                  },
                  {
                      titre: 'Concentration',
                      note1: "0",
                      commentaire: "Bonne concentration. Tu peux  encore progresser dans ce domaine."
                  },
                  {
                      titre: "Application",
                      note1: "0",
                      commentaire: "Bonne application générale."
                  },
                  {
                      titre: "Joueur Équipier",
                      note1: "0",
                      commentaire: "J'attends encore plus de toi dans ce domaine pour être un leader d'équipe"
                  },
                ],

              }
            ],
          },

          sec_critere: {
            titre: 'Habiletés Techniques',
            sous_criteres:[
              {
                titre: 'Orientation du corps',
                notes: [
                  {
                    titre: 'Position des épaules/jeu de corps',
                    note1: '0',
                    commentaire: "Bonne utilisation de ton corps dans les différents aspects du jeu."
                  },
                ],
              },
              {
                titre: 'maitrise individuelle',
                notes: [
                  {
                      titre: "Jonglage",
                      note1: "0",
                      commentaire: "Tes résultats au gonglage sont insuffisantes Tu peux les développer(pied faible et tête). J'attends plus de toi"
                  },
                  {
                      titre: "Conduite de balle",
                      note1: "0",
                      commentaire: "Tu dois améliorer les changements de direction et la vitesse d'éxécution."
                  },
                  {
                      titre: "Dribbles et feintes",
                      note1: "0",
                      commentaire: "Correct en général. Tu doit penser à enrichir ton arsenal technique."
                  },
                  {
                      titre: "Protection de Ballon",
                      note1: "0",
                      commentaire: "Bon usage de ton corps obstacle. "
                  },
                  {
                      titre: "Première touche ",
                      note1: "0",
                      commentaire: "Bonne première touche qui te permet d'enchaîner rapidement."
                  },
                  {
                      titre: "Contrôles  orientés ",
                      note1: "0",
                      commentaire: "Tu as compris que le ballon devait rester en mouvement."
                  },
                  {
                      titre: "Contrôles  aériens",
                      note1: "0",
                      commentaire: "Peu utilisé. Mais cela le deviendra avec le jeu à 11 "
                  },
                ],
              },
              {
                titre: 'Technique de frappe',
                notes: [
                  {
                      titre: "Passes courtes",
                      note1: "0",
                      commentaire: "Bon niveau qui permet de construire nos actions depuis le GK. Continue de développer pied faible."
                  },
                  {
                      titre: "Passes moyennes",
                      note1: "0",
                      commentaire: "Bon niveau qui te permet d'augmenter et élargir tes choix.Continue de travailler pied faible."
                  },
                  {
                      titre: "Passes longues",
                      note1: "0",
                      commentaire: "Peu exploité. Mais doit être travaillé."
                  },
                  {
                      titre: "Centres",
                      note1: "0",
                      commentaire: "",
                  },
                  {
                      titre: "Volée ",
                      note1: "0",
                      commentaire: "",
                  },
                  {
                      titre: "Tirs",
                      note1: "0",
                      commentaire: "Bonne qualité de tirs, tu dois pouvoir trouver des situations de tirs lors des matchs"
                  },
                  {
                      titre: "Jeu de tête",
                      note1: "0",
                      commentaire: "Peu utilisé."
                  },
                  {
                      titre: "Pied Faible",
                      note1: "0",
                      commentaire: "Tu dois encore travailler le pied faible."
                  },
                ],
              },
              {
                titre: 'Technique défensive',
                notes: [
                  {
                    titre: "1 c 1",
                    note1: "0",
                    commentaire: "Bonne intelligence de jeu pour gagner les duels défensifs."
                  },
                ],
              },

            ],
          },

          thi_critere: {
            titre: 'Habiletés Tactiques',
            sous_criteres:[
              {
                titre: 'Implication dans le jeu offensif',
                notes: [
                  {
                      titre: "Vision de jeu ",
                      note1: "0",
                      commentaire: "Bonne Prise d'information qui doit te permettre d'élargir plus ton registre de jeu"
                  },
                  {
                      titre: "Créativité et prise d'initiatives",
                      note1: "0",
                      commentaire: "Ta prise d'initiatives est bonne. J'attends encore plus de toi."
                  },
                  {
                      titre: "Placement",
                      note1: "0",
                      commentaire: "Tu as bien compris le positionnement de ta zone de jeu."
                  },
                  {
                      titre: "Déplacement",
                      note1: "0",
                      commentaire: "J'attends encore plus de toi dans la notion d'aide au porteur."
                  },
                ],
              },
              {
                titre: 'Implication dans le jeu défensif',
                notes: [
                  {
                      titre: "Attitude à la perte de balle",
                      note1: "0",
                      commentaire: "Reste attentif aux transitions attaque/défense."
                  },
                  {
                      titre: "Mise en pratique des principes de zone (cadrage, couverture, coulissage…)",
                      note1: "0",
                      commentaire: "Tu as bien compris les grands principes d'une défense en zone.En cours d'acquisition."
                  },
                  {
                      titre: "Anticipation",
                      note1: "0",
                      commentaire: "En améliorant ta lecture de jeu, ton anticipation sera meilleure."
                  },
                  {
                      titre: "Replacement",
                      note1: "0",
                      commentaire: "J'attends plus de toi à la perte de balle."
                  },
                ],
              },
            ],
          },

          fou_critere: {
            titre: 'Qualités physiques',
            sous_criteres:[
              {
                titre: 'Etat physique',
                notes: [
                  {
                      titre: "Motricité",
                      note1: "0",
                      commentaire: "Tu dois poursuivre le travail de maîtrise des appuis et ta coordination œil/pied."
                  },
                  {
                      titre: "Vivacité",
                      note1: "0",
                      commentaire: "Moyen. Poursuis ton travail d'appuis. Compléter par un travail de gainage que nous allons entreprendre."
                  },
                  {
                      titre: "Vitesse",
                      note1: "0",
                      commentaire: "Moyen. Tu dois compenser une vitesse moyenne par un très bon placement."
                  },
                  {
                      titre: "Endurance",
                      note1: "0",
                      commentaire: "J'attends encore plus de toi dans la répétition des efforts donc ton volume de jeu."
                  },
                  {
                      titre: "Puissance",
                      note1: "0",
                      commentaire: ""
                  },
                  {
                      titre: "Souplesse",
                      note1: "0",
                      commentaire: ""
                  }
                ],
              }
            ],
          },
        },

        testMoreInfo: {},
        
        tests: [],

      },
      

      computed: {
        getFilteredUsers() {
          return this.filterUsersCategorieJoueur(this.filterUsersGender(this.users))
        },
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

        filterUsersGender(users){
          return users.filter(user => !user.gender.indexOf(this.gender))
        },
        filterUsersCategorieJoueur(users){
          return users.filter(user => !user.categorie_joueur.indexOf(this.categorie_joueur))
        },

        filterUserFromIdJoueur(id_joueur){
          
          var user = this.users.find(
            function(post, index) {
            if(post.id == id_joueur)
              return true;
          });
            
          return user;
        },



        addTest() {
          // then send test          
          axios.post(window.Laravel.url+"/addtest", {json_test: JSON.stringify(this.test), id_joueur: this.test.id_joueur})
          .then(response =>{
            console.log(response.data.tests);
            this.tests = response.data.tests;
            Swal.fire(
              '',
              'A new test has been created',
              'success',
            )
          })
          .then(error =>{
            console.log(error);            
          })
        },


        getJoueurs: function(){
          axios.get(window.Laravel.url+"/getjoueurs")
          .then(response => {
            this.users = response.data;
            console.log(this.users);
          })
          .catch(error => {
            console.log('errors: ',error);
          })
        },


        gettests: function(){
          axios.get(window.Laravel.url+"/gettests")
          .then(response => {
            this.tests = response.data;
            console.log(this.tests);
          })
          .catch(error => {
            console.log('errors: ',error);
          })
        },

      },

      created:function(){
        this.getJoueurs();
        this.gettests();
      },


    });


</script>

@endsection
