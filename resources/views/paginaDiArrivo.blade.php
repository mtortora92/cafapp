Questa è la pagina di arrivo quando si è loggati<br><br>
@php
    $user = Auth::user();

    if(Auth::check()){
        echo "complimenti, ti sei loggato";
    } else {
        echo "non sei loggato";
    }

    echo"<br><br>";

    echo "$user->id, $user->nome, $user->cognome, $user->idRuolo";
@endphp



<form action="{{ route('logout') }}" method="POST">
    {{ csrf_field() }}
    <button type="submit">Logout</button>
</form>