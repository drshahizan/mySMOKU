<x-default-layout>
    <!--begin::Page title-->
	<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
		<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Pelaporan</h1>
		<!--begin::Breadcrumb-->
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<li class="breadcrumb-item text-dark" style="color:darkblue">Pelaporan</li>
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-400 w-5px h-2px"></span>
			</li>
			<li class="breadcrumb-item text-dark" style="color:darkblue">Permohonan</li>
		</ul>
		<!--end::Breadcrumb-->
	</div>
	<!--end::Page title-->

    <br>
	<!--begin::Accordion-->
    <div class="accordion" id="accordionPanelsStayOpenExample">
        
		<div class="accordion-item">
			
			<iframe id="myIframe" title="BKOKUMohon" width="100%" height="1060" frameborder="0" allowFullScreen="true"></iframe>
		</div>

	</div>
	<!--end::Accordion-->
	
	<script>
		// Set the iframe source dynamically using JavaScript
		document.getElementById('myIframe').src = 'https://app.powerbi.com/view?r=eyJrIjoiZmQyMzBmNmMtNGE4NC00MjA4LTgyNmItZTM3MmJmZThkN2ZmIiwidCI6ImJiMmIwZjRjLTU2NzAtNDY3ZC1iN2NkLTgwZDI3YTAzMDAyMyIsImMiOjEwfQ%3D%3D';
	</script>

</x-default-layout>
