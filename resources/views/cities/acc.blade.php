@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'new-city'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Nouvelle ville</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="/acc" autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="alert alert-info alert-with-icon alert-dismissible fade show"
                                            data-notify="container">
                            <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                <i class="nc-icon nc-simple-remove"></i>
                             </button>
                             <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                             <span data-notify="message">(<span style="color:brown;">*</span>) Ce champs est obligatoire
                            </span>
                            </div>
                            <div class="form-group">
                              <label for="la-ville">La ville <span style="color:brown;">*</span></label>
                              <input type="search" class="form-control" id="form-address" placeholder="La ville ?" />
                            </div>
                            <div class="form-group">
                                <label for="la-ville">Les taches </label>
                                <input name="tasks[]" type="text" class="form-control" id="form-address" placeholder="" /><br>
                                <input name="tasks[]" type="text" class="form-control" id="form-address" placeholder="" />
                            </div>
                            <input name="lat" type="hidden" class="form-control" id="form-lat"/>
                            <input name="lon" type="hidden" class="form-control" id="form-lon"/>
                            <input name="city" type="hidden" class="form-control" id="form-city"/>
                            <button type="submit" class="btn btn-info">Soumettre</button>
                          </form>
                          <div class="row">
                              {{ $test="t value" }}
                              {{$test}}

                                <button class="add">Add</button>
                                <button class="remove">remove</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/places.js@1.16.5"></script>
<script src="https://stacksnippets.net/scripts/snippet-javascript-console.min.js?v=1"></script>

<script type="text/javascript">
        (function() {
          var placesAutocomplete = places({
            appId: 'plC3I2T61MBI',
            apiKey: 'f7ec78f02cce3a6a89532021b2f7a89c',
            container: document.querySelector('#form-address'),
            templates: {
              value: function(suggestion) {
                return suggestion.name;
              }
            }
          }).configure({
            type: 'city',
            countries: ['ma']
          });
          placesAutocomplete.on('change', function resultSelected(e) {
            document.querySelector('#form-lat').value = e.suggestion.latlng.lat || '';
            document.querySelector('#form-lon').value = e.suggestion.latlng.lng || '';
            document.querySelector('#form-city').value = e.suggestion.name || '';
          });
        })();
</script>
<script>
$('.add').on('click', add);
$('.remove').on('click', remove);

function add() {
  var new_chq_no = parseInt($('#total_chq').val()) + 1;
  var new_input = "<input type='text' name='tasks[]'>";

  $('#new_chq').append(new_input);

  $('#total_chq').val(new_chq_no);
}

function remove() {
  var last_chq_no = $('#total_chq').val();

  if (last_chq_no > 1) {
    $('#new_' + last_chq_no).remove();
    $('#total_chq').val(last_chq_no - 1);
  }
}
</script>
@endpush

@endsection
