@extends('layouts.coach-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<h2 class="top-header">Announcements</h2>
	</div>

    {{ csrf_field() }}

	<div class="content-container-lg">
        <div class="table-container">
            <table class="table table-bordered table-hover">
                <col style="width:10%">
                <col style="width:10%">
                <col style="width:10%">
                <col style="width:65%">
                <col style="width:5%">
                <thead>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Coach</th>
                    <th>Announcement</th>
                    <td>Delete</td>
                </thead>
                <tbody>
                    @foreach ($team->announcements() as $announcement)
                        <tr>
                            <td>{{ $announcement->date }}</td>
                            <td>{{ $announcement->time }}</td>
                            <td>{{ $announcement->coach }}</td>
                            <td>{{ $announcement->text }}</td>
                            <td><a href="{{ route('delete-announcement', $announcement->id) }}" id='remove'><img class="minus" src="{{ asset('/images/red-minus-hi.png') }}"></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
	</div>

	<div class="footer">
		<a class="add-button" href="{{ route('add-announcement') }}">
			<button class="btn btn-default btn-bottom-right">Add Announcement</button>
		</a>
	</div>
</div>

<script>
function removeAnnouncement(id) {
    if (confirm("Delete announcement?")) {
        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", "/coach/delete-announcement");   

        var id = document.createElement("input");
        id.setAttribute("type", "hidden");
        id.setAttribute("name", "id");
        id.setAttribute("value", id);
        form.appendChild(id);
            
        var csrf_field = document.createElement("input");
        csrf_field.setAttribute("type", "hidden");
        csrf_field.setAttribute("name", "_token");
        csrf_field.setAttribute("value", $("input[name=_token]").val());
        form.append(csrf_field);

        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection