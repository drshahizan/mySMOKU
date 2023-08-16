<x-default-layout> 

<body>


	{{$data->name}}
	{{$data->description}}

	<iframe height="400"  width="400" src="/assets/{{$data->file}}"></iframe>

</body>

</x-default-layout> 