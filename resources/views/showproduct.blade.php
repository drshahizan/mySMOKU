<x-default-layout> 
<body>

	<table border="1px">

	<tr>
		<th>Name</th>
		<th>Description</th>
		<th>View</th>
		<th>Download</th>
	</tr>

	@foreach($data as $data)

	<tr>
		<td>{{$data->name}}</td>
		<td>{{$data->description}}</td>
		<td><a href="{{url('/view',$data->id)}}">View</a></td>
		<td><a href="{{url('/download',$data->file)}}">Download</a></td>


	</tr>
	



	@endforeach

	</table>

</body>


</x-default-layout> 