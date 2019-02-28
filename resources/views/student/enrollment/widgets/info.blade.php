<ul class="list-group">
    <li class="list-group-item">Gender: <strong>{{$enrollment->gender}}</strong></li>
    <li class="list-group-item">Date of birth: <strong>{{$enrollment->dob}}</strong></li>
    <li class="list-group-item">Nationality: <strong>{{$enrollment->nationality}}</strong></li>
    <li class="list-group-item">State: <strong>{{$enrollment->state}}</strong></li>
    <li class="list-group-item">LGA: <strong>{{$enrollment->lga}}</strong></li>
    <li class="list-group-item">Town: <strong>{{$enrollment->town}}</strong></li>
    <li class="list-group-item">Home Address: <strong>{{$enrollment->home_address}}</strong></li>
    <li class="list-group-item">Ailment: <strong>{{$enrollment->ailment === null ? 'N/A' : $enrollment->ailment}}</strong></li>
    <li class="list-group-item">Siblings: <strong>{{$enrollment->siblings}}</strong></li>
</ul>