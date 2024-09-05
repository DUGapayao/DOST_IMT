@extends('dashboard')

@section('title', 'Users')

@section('table-content')
        <!--
        <div>
            <a href="{{route('hnrda.create')}}">Add HNRDA</a>
        </div>
        !-->
            <thead>
                <tr>
                    <th>NAME</th>
                    <th>AGENCY</th>
                    <th>EMAIL ADDRESS</th>
                    <th>CONTACT</th>
                    <th>ACCESS LEVEL</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($allUser as $User)
                    <tr>
                        
                        <td> {{ $User->name }} </td>
                        <td> {{ $User->agency }} </td>
                        <td> {{ $User->email }} </td>
                        <td> {{ $User->contact }} </td>
                        <td> {{ $User->role }} </td>

                        <td>
                            <a href="{{ route('user.edit', ['user' => $User]) }}" class="action-edit">
                                Edit
                            </a>
                        </td>

                        <td>
                            <form method="post" action="{{ route('user.destroy', ['user' => $User]) }}">
                                @csrf
                                @method('delete')
                                <input class="submit-delete" type="submit" value="Delete">
                            </form>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
@endsection