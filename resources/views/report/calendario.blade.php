
@extends('principal.index')

@section('title','Lista de Articulos')

@section('content')
<div class="panel panel-default">
    <!-- Content Header (Page header) -->
    <div class="panel-heading"><h2> Calendario </h2>  </div>
    <div class="panel-body">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
            </div>
            <div class="box-body">
              <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                </ul>
              </div>
              <!-- /btn-group -->
              <div class="input-group">
                <!-- /btn-group -->
              </div><br/><br/>
              <!-- /input-group -->
              {!! Form::open(['route' => ['guardaEventos'], 'method' => 'POST', 'id' =>'form-calendario']) !!}
              {!! Form::close() !!}
            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
   </div><!-- /.panel-body -->
  </div><!-- /.panel -->
</div>
</div>
@endsection

@section('scripts')
   <script>
  $(function () {
    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {
        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 1070,
          revert: true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        });

      });
    }

    ini_events($('#external-events div.external-event'));

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
  //while(reload==false){
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'hoy',
        month: 'mes',
        week: 'semana',
        day: 'dia'
      },

      events: {url: "cargaEventos" + {{ Auth::user()->id }} +""},

      editable: false,
      droppable: false, // this allows things to be dropped onto the calendar !!!
      //PopUp
      eventMouseover: function( event, jsEvent, view ) { 
        var start = (event.start.format("HH:mm"));
        var back='#3c8dbc';
        if(event.end){
            var end = event.end.format("HH:mm");
        }else{var end="No definido";
        }
        if(event.allDay){
            var allDay = "Si";
        }else{var allDay="No";
        }
        var tooltip = '<div class="tooltipevent" style="width:200px;height:100px;color:white;background:'+back+';position:absolute;z-index:10001;">'+'<center>'+ event.title +'</center>'+'Todo el dia: '+allDay+'<br>'+ 'Inicio: '+start+'<br>'+ 'Fin: '+ end +'</div>';
        $("body").append(tooltip);
        $(this).mouseover(function(e) {
          $(this).css('z-index', 10000);
          $('.tooltipevent').fadeIn('500');
          $('.tooltipevent').fadeTo('10', 1.9);
        }).mousemove(function(e) {
          $('.tooltipevent').css('top', e.pageY + 10);
          $('.tooltipevent').css('left', e.pageX + 20);
        });            
      },
      // quitarlo cuando el mouse no esta sobre el
      eventMouseout: function(calEvent, jsEvent) {
        $(this).css('z-index', 8);
        $('.tooltipevent').remove();
      },
      // Enviar al día seleccionado
      dayClick: function(date, jsEvent, view) {
            if (view.name === "month") {
                $('#calendar').fullCalendar('gotoDate', date);
                $('#calendar').fullCalendar('changeView', 'agendaDay');
            }
      },
      //Seleccionar un evento
      eventClick: function(calEvent, jsEvent, view) {

        alert('Event: ' + calEvent.title+'\n'+calEvent.content)
        // change the border color just for fun
        $(this).css('border-color', 'red');
      }
    });

    /* AGREGANDO EVENTOS AL PANEL */
    var currColor = "#3c8dbc"; //Red by default
    //Color chooser button
    var colorChooser = $("#color-chooser-btn");
    $("#color-chooser > li > a").click(function (e) {
      e.preventDefault();
      //Save color
      currColor = $(this).css("color");
      //Add color effect to button
      $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
    });
    $("#add-new-event").click(function (e) {
      e.preventDefault();
      //Get value and make sure it is not null
      var val = $("#new-event").val();
      if (val.length == 0) {
        return;
      }
      //Create events
      var event = $("<div />");
      event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
      event.html(val);
      $('#external-events').prepend(event);

      //Add draggable funtionality
      ini_events(event);

      //Remove event from text input
      $("#new-event").val("");
    });
  });
</script>
@endsection