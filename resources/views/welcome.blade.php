
@extends( 'layout' )
@section('content')
                @forelse ( $groups as $group)
                  <h3> {{ $group->group_name }} </h3>
                  @empty( $group->group_name )
                    {{ $group->group_id }}: Has no group name, import cvs a group cvs.
                  @endempty
                  <table>
                  
                  </table>
                @empty
                  <p>No Groups. Use the csv tool to import data.</p>
                @endforelse
@endsection
