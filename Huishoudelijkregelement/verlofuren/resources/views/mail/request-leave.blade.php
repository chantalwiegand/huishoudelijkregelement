<h1>Verlof aanvraag</h1>
<p>
    {{$firstname.' '.$prefix.' '.$lastname}} heeft verlof aangevraagd.<br>
    Hij/zij zou graag verlof willen hebben van {{date('d-m-Y', strtotime($start_date))}} tot {{date('d-m-Y', strtotime($end_date))}}. <br>
    Dit is {{$hours_of_leave}} uur.
</p>
