@extends('layouts.app')

@section('content')

<div id="app" class="container" style="margin-top: 100px">
      <table class="table">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">company name</th>
            <th class="text-center" scope="col">domain</th>
            <th class="text-center" scope="col">email</th>
            <th class="text-center" scope="col">phone</th>
            <th scope="col" class="text-right">action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="partner in partners">
            <th scope="row"><img :src="'storage/'+partner.image" alt="Admin" class="rounded-circle" width="30"></th>
            <td>@{{ partner.name }}</td>
            <td class="text-center">@{{ partner.titre }}</td>
            <td class="text-center">@{{ partner.email }}</td>
            <td class="text-center">@{{ partner.telephone }}</td>
            <th scope="col" class="text-right">
              <span href="" @click="deleteEntreprise(partner)" class="delete-icon"><i style="color: red" class="fas fa-trash-alt"></i></span>
            </th>
          </tr>
        </tbody>
      </table>
</div>


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
      'partners' => $partners,
      'url'   =>  url('/')
    ]) !!};
</script>

<script>
  
    var app = new Vue({
      el : '#app',

      data :{
        partners: window.Laravel.partners,
      },
      methods:{


        deleteEntreprise(partner){
          axios.post(window.Laravel.url+'/deleteEntreprise',partner)
          .then(res => {
            this.partners = res.data.partners;
          })
        },


      },
    });


</script>

@endsection
