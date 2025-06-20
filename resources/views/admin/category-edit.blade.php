@extends('layouts.admin')
@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>category edit</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{ route('admin.index') }}">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <a href="{{ route('admin.categories') }}">
                        <div class="text-tiny">category</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">edit category</div>
                </li>
            </ul>
        </div>
        <!-- new-category -->
        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{route('admin.category.update') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $category->id }}"/>
                <fieldset class="name">
                    <div class="body-title">category Name <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="category name" name="name"
                        tabindex="0" value="{{$category->name }}" aria-required="true" required="">
                        @error('name') <span class="alert alert-danger text-danger">{{ $message }} </span>@enderror
                       
                </fieldset>
                <fieldset class="name">
                    <div class="body-title">category Slug <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="category Slug" name="slug"
                       tabindex="0" value="{{$category->slug}}" aria-required="true" required="">
                       @error('slug') <span class="alert alert-danger text-danger">{{ $message }} </span>@enderror
                           
                </fieldset>
                <fieldset>
                    <div class="body-title">Upload images <span class="tf-color-1">*</span>
                    </div>
                    <div class="upload-image flex-grow">
                        @if ($category->image)
                        <div class="item" id="imgpreview">
                            <img src="{{ asset('uploads/categories') }}/{{ $category->name }}" class="effect8" alt="">
                        </div>
                        @endif
                        <div id="upload-file" class="item up-load">
                            <label class="uploadfile" for="myFile">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="body-text">Drop your images here or select <span
                                        class="tf-color">click to browse</span></span>
                                <input type="file" id="myFile" name="image" accept="image/*">
                            </label>
                        </div>
                    </div>
                </fieldset>
                @error('image') <span class="alert alert-danger text-danger">{{ $message }} </span>@enderror
                <div class="bot">
                    <div></div>
                    <button class="tf-button w208" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
$(function(){
    $('#myFile').on("change", function(e){
        const photoInp = $('#myFile');
        const[file] = this.files;
        if(file){
            $("#imageview img").altr('src',URL.createObjectURL(file));
            $("#imageview").show();
        }
    }); 

    $("input[name='name']").on("change",function(){
        $("input[name='slug']").val(StringToSlug($(this).val()));

    });
    
});
function StringToSlug(Text)
    {
        return Text.toLowerCase()
        .replace(/[^\w]+/g,"")
        .replace(/ +/g,"-");
        
    }
</script>

@endpush