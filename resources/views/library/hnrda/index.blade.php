@extends('dashboard')

@section('title', 'HARMONIZED NATIONAL RESEARCH AND DEVELOPMENT AGENDA (HNRDA)')

@section('table-content')
        <div>
            <a href="{{route('hnrda.create')}}">Add HNRDA</a>
        </div>
            <thead>
                <tr>
                    <th>TITLE</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($allHnrda as $Hnrda)
                    <tr>
                        <td> {{ $Hnrda->title }} </td>
                        <td>
                            <a href="{{ route('hnrda.edit', ['hnrda' => $Hnrda]) }}" class="action-edit">
                                Edit
                            <!--
                            <form method="get" action="{{ route('hnrda.edit', ['hnrda' => $Hnrda]) }}">
                                <input class="submit-edit" type="submit" value="Edit">
                            </form>
                            !-->

                            </a>
                        </td>
                        <td>
                            <form method="post" action="{{ route('hnrda.destroy', ['hnrda' => $Hnrda]) }}">
                                @csrf
                                @method('delete')
                                <input class="submit-delete" type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
@endsection