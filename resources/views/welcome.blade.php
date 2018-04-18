
@extends( 'layout' )
@section('content')
  <div class="row">
  <div class="col-3">
    <h2>Groups</h2>
    <nav class="nav flex-column">
                @forelse ( $groups as $group)
                  <a href="" class="" ajax-call="{{ action('Group@listPeople', $group->group_id)}}"> {{ $group->group_name }} </a>
                  @empty( $group->group_name )
                    <a href="" class="">Group ID: {{ $group->group_id }}</a>
                  @endempty
                  
                @empty
                  <p>No Groups. Use the csv tool to import data.</p>
                @endforelse
    </nav>
  </div>
  <div class="col">
                  <table id="groups_table" class="table table-striped">
                  <caption>Select a Group to see a list Members.</caption>
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">First Name</th>
                      <th scope="col">Last Name</th>
                      <th scope="col">Email</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  </table>
  </div>
</div>

@endsection
