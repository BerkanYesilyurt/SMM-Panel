@extends('layout')
@section('subTitle', 'FAQ')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">{{$configsArray['title']}} /</span> F.A.Q.
        </h4>



                    @forelse($faqs as $faq)
                    <div class="card accordion-item">
                        <h2 class="accordion-header" id="heading{{$faq->id}}">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion{{$faq->id}}" aria-expanded="false" aria-controls="accordion{{$faq->id}}">
                               {{$loop->iteration}}-) {{$faq->question}}
                            </button>
                        </h2>
                        <div id="accordion{{$faq->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$faq->id}}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    </div><br>
                    @empty
                        <tr>
                            <td colspan="5"><br>
                                <center>
                                    <b>No Records Found.</b>
                                </center>
                                <br></td>
                        </tr>
                    @endforelse

    </div>
@endsection
