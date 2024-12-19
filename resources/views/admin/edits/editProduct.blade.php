@extends('admin.admin-master')

@section('title')
Admin | Edit Product
@endsection
@section('admin')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Product Page</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="active">
                                    <a href="{{ route('view_products') }}" class="btn btn-primary">View All Products </a>
                                </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title pb-0">Edit Product</h1>
                        </div>
                        <div class="card-body">

                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Warning!</strong> All categories must have subcategories before a product can be properly uploaded. <br>
                                Click 
                                <b>
                                    <a href="{{ url('admin/add/category') }}" class="alert-link">here</a> 
                                </b>to add a Category and 
                                <b>
                                    <a href="{{ url('admin/add/sub-category') }}" class="alert-link">here</a>
                                </b>
                                 to add a Subcategory
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                              
                            <form method="post" action="{{ route('update_product') }}" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{ $product->id }}">

                                <div class="row mt-1">
                                    <div class="col-12 col-md-6 mb-2">
                                        <label for="example-text-input" class="form-label">Product Title <span
                                                class="text-danger">*</span></label>
                                        <div class="col-12">
                                            <input name="title" class="form-control" type="text"
                                                id="example-text-input" value="{{ $product->title }} ">
                                        </div>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <label for="example-text-input" class="form-label">SKU</label>
                                        <div class="col-12">
                                            <input name="sku" class="form-control" type="text"
                                                id="example-text-input" value="{{ $product->sku }} " {{ 'readonly' }}>
                                        </div>
                                        @error('sku')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row mt-1">
                                    <div class="col-12 col-md-6 mb-2">
                                        <label for="example-text-input" class="form-label">Category <span
                                                class="text-danger">*</span></label>
                                        <div class="col-12">
                                            <select name="category_id" class="form-select" id="changeCategory">
                                                <option value="">Select</option>
                                                @foreach ($categories as $category)
                                                    <option {{ $product->category_id == $category->id ? 'selected' : '' }}
                                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <label for="example-text-input" class="form-label">Sub Category <span
                                                class="text-danger">*</span></label>
                                        <div class="col-12">
                                            <select name="subcategory_id" id="getSubCategory" class="form-select"
                                                id="">
                                                <option value="">Select</option>
                                                @foreach ($getSubCategory as $subCategory)
                                                    <option
                                                        {{ $product->subcategory_id == $subCategory->id ? 'selected' : '' }}
                                                        value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('subbcategory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-12 mb-2">
                                        <label for="example-text-input" class="form-label">Brand</label>
                                        <div class="col-12">
                                            <select name="brand_id" class="form-select" id="">
                                                <option value="">Select</option>
                                                @foreach ($brands as $brand)
                                                    <option {{ $product->brand_id == $brand->id ? 'selected' : '' }}
                                                        value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('brand_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-12 col-md-12 mb-2">
                                        <label for="example-text-input" class="form-label">Color</label>
                                        <div class="col-12">
                                            @foreach ($colors as $color)
                                                @php
                                                    $checked = '';
                                                @endphp
                                                @foreach ($product->getColor as $pColor)
                                                    @if ($pColor->color_id == $color->id)
                                                        @php
                                                            $checked = 'checked';
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <div>
                                                    <label class="form-label">
                                                        <input type="checkbox" {{ $checked }} name="color_id[]"
                                                            value="{{ $color->id }}">{{ $color->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('color_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-12 col-md-12 mb-2">
                                        <label for="example-text-input" class="form-label">Size </label>
                                        <div class="col-12">
                                            <table class="table">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Price (€)</th>
                                                        <th>Aciton</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="appendSize">
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                    @foreach ($product->getSize as $size)
                                                        <tr id="deleteSize{{ $i }}">
                                                            <td>
                                                                <input type="text" value="{{ $size->name }}"
                                                                    placeholder="Name"
                                                                    name="size[{{ $i }}][name]"
                                                                    class="form-control">
                                                            </td>
                                                            <td>
                                                                <input type="text" value="{{ $size->price }}"
                                                                    placeholder="Price"
                                                                    name="size[{{ $i }}][price]"
                                                                    class="form-control">
                                                            </td>
                                                            <td style="width: 200px">
                                                                <button type="button" id="{{ $i }}"
                                                                    class="btn btn-danger deleteSize">Delete</button>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endforeach
                                                    <tr>
                                                        <td>
                                                            <input type="text" placeholder="Name"
                                                                name="size[100][name]" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" placeholder="Price"
                                                                name="size[100][price]" class="form-control">
                                                        </td>
                                                        <td style="width: 200px">
                                                            <button type="button"
                                                                class="btn btn-primary addSize">Add</button>
                                                        </td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <div class="row mt-1">
                                    <div class="col-12 col-md-6 mb-2">
                                        <label for="example-text-input" class="form-label">Price <span
                                                class="text-danger">*</span></label>
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">€</span>
                                                <input name="price" class="form-control" type="text" id="price"
                                                    value="{{ !empty($product->price) ? $product->price : '' }}">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <label for="example-text-input" class="form-label">Old Price <span
                                                class="text-danger">*</span></label>
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">€</span>
                                                <input name="old_price" class="form-control" type="text"
                                                    id="old_price"
                                                    value="{{ !empty($product->old_price) ? $product->old_price : '' }}">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                        @error('old_price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <hr>

                                <div class="row mt-2">
                                    <div class="col-12 col-md-12 ">
                                        <label for="example-text-input" class="form-label">Image <span
                                                class="text-danger">*</span></label>
                                        <div class="col-12">
                                            <div class="fallback">
                                                <input name="image[]" class="form-control" type="file"
                                                    multiple="multiple" accept="image/*">
                                            </div>
                                        </div>

                                        {{-- @if (!empty($product->getImage->count())) --}}
                                            <div class="row mt-4" id="sortable">
                                                @foreach ($product->getImage as $image)
                                                    @if (!empty($image->getAllImages()))
                                                        <div class="col-md-2 col-12 mb-1 sortable_image"
                                                            style="text-align: center" id="{{ $image->id }}">
                                                            <img style="width: 100%; height: 100px"
                                                                class="rounded avatar-lg img-repsonsive img-fluid"
                                                                src="{{ $image->getAllImages() }}" alt="Card image cap"
                                                                width="100%">
                                                            <a href="{{ route('image_delete', $image->id) }}"
                                                                onclick="return confirm('Are you sure you want to delete this Image?')"
                                                                class="btn btn-danger btn-sm mt-2">Delete</a>
                                                        </div>

                                                    @endif
                                                @endforeach
                                                <p claas="text-muted">You can drag the Image that you want to have in front
                                                </p>
                                            </div>
                                        {{-- @endif --}}
                                    </div>
                                </div>

                                <hr>

                                <div class="row mt-2">
                                    <div class="col-12 col-md-12 mb-2">
                                        <label for="example-text-input" class="form-label">Short Description <span
                                                class="text-danger">*</span></label>
                                        <div class="col-12">
                                            <textarea name="short_description" class="form-control" placeholder="short description" id="">{{ trim($product->short_description) }}</textarea>
                                        </div>
                                        @error('short_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mt-2">
                                    <div class="col-12 col-md-12 mb-2">
                                        <label for="example-text-input" class="form-label">Description <span
                                                class="text-danger">*</span></label>
                                        <div class="col-12">
                                            <textarea name="description" class="form-control" placeholder="" id="description">
                                                {{ $product->description }}
                                            </textarea>
                                        </div>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->


                                <div class="row mt-2">
                                    <div class="col-12 col-md-12 mb-2">
                                        <label for="example-text-input" class="form-label">Additional information <span
                                                class="text-danger">*</span></label>
                                        <div class="col-12">
                                            <textarea name="additional_information" class="form-control" placeholder="Additional information"
                                                id="additional_information">
                                                {{ $product->additional_information }}
                                            </textarea>
                                        </div>
                                        @error('additional_information')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mt-2">
                                    <div class="col-12 col-md-12 mb-2">
                                        <label for="example-text-input" class="form-label">Shiipping Returns <span
                                                class="text-danger">*</span></label>
                                        <div class="col-12">
                                            <textarea name="shipping_returns" class="form-control" placeholder="Shipping returns" id="shipping_returns">
                                                {{ $product->shipping_returns }}
                                            </textarea>
                                        </div>
                                        @error('shipping_returns')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="col-12 col-md-12 mb-4 mt-2">
                                    <label for="example-text-input" class="form-label">Status <span
                                            class="text-danger">*</span></label>
                                    <div class="col-12">
                                        <select name="status" id="" class="form-select">
                                            <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                    </div>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>



                                <input type="submit" class="btn btn-info waves-effect waves-light"
                                    value="Update  Product">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('backend/assets/js/jQuery_UI.js') }}"></script>

    <script>
        $(document).ready(function() {

            $("#sortable").sortable({
                update: function(event, ui) {
                    var photo_id = [];

                    $('.sortable_image').each(function () {
                        var id = $(this).attr('id');
                        photo_id.push(id);
                    })

                    // alert(photo_id);

                $.ajax({
                    url: "{{ url('admin/product_image_sort') }}",
                    type: 'POST',
                    data: {
                        photo_id: photo_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {

                    },
                    error: function(error) {

                    }
                });

                }
            });

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {


            $('#changeCategory').change((e) => {
                let id = $('#changeCategory').val();
                $.ajax({
                    url: "{{ url('admin/get_SubCategory') }}",
                    type: 'POST',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#getSubCategory').show().html(data.html)
                    },
                    error: function(error) {

                    }
                });
            });

            // Add Size
            var i = 101;
            $('.addSize').click(() => {
                let html = `<tr id="deleteSize${i}">
                               <td>
                                   <input type="text" name="size[${i}][name]" placeholder="Name" class="form-control">
                                </td>
                                <td>
                                   <input type="text" name="size[${i}][price]" placeholder="Price"  class="form-control">
                                </td>
                                <td>
                                    <button type="button" id="${i}" class="btn btn-danger deleteSize">Delete</button>
                                </td>
                            </tr>`;
                i++;
                $('#appendSize').append(html);
            })


            // Use event delegation to attach the click event handler to dynamically created elements
            $(document).on('click', '.deleteSize', function() {
                var id = $(this).attr('id');
                $(`#deleteSize${id}`).remove();
            });

        });
    </script>


    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/super-build/ckeditor.js"></script>
    <script>
        CKEDITOR.ClassicEditor.create(document.getElementById("description"), {
            toolbar: {
                items: [
                    'exportPDF', 'exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript',
                    'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed',
                    '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                    {
                        model: 'heading5',
                        view: 'h5',
                        title: 'Heading 5',
                        class: 'ck-heading_heading5'
                    },
                    {
                        model: 'heading6',
                        view: 'h6',
                        title: 'Heading 6',
                        class: 'ck-heading_heading6'
                    }
                ]
            },
            placeholder: 'Description',
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            fontSize: {
                options: [10, 12, 14, 'default', 18, 20, 22],
                supportAllValues: true
            },
            htmlSupport: {
                allow: [{
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }]
            },
            htmlEmbed: {
                showPreviews: true
            },
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            mention: {
                feeds: [{
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
                        '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                        '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
                        '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }]
            },
            removePlugins: [
                'CKBox',
                'CKFinder',
                'EasyImage',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                'MathType',
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents'
            ]
        });
        CKEDITOR.ClassicEditor.create(document.getElementById("additional_information"), {
            toolbar: {
                items: [
                    'exportPDF', 'exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript',
                    'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed',
                    '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                    {
                        model: 'heading5',
                        view: 'h5',
                        title: 'Heading 5',
                        class: 'ck-heading_heading5'
                    },
                    {
                        model: 'heading6',
                        view: 'h6',
                        title: 'Heading 6',
                        class: 'ck-heading_heading6'
                    }
                ]
            },
            placeholder: 'Additional Information',
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            fontSize: {
                options: [10, 12, 14, 'default', 18, 20, 22],
                supportAllValues: true
            },
            htmlSupport: {
                allow: [{
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }]
            },
            htmlEmbed: {
                showPreviews: true
            },
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            mention: {
                feeds: [{
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
                        '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                        '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
                        '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }]
            },
            removePlugins: [
                'CKBox',
                'CKFinder',
                'EasyImage',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                'MathType',
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents'
            ]
        });
        CKEDITOR.ClassicEditor.create(document.getElementById("shipping_returns"), {
            toolbar: {
                items: [
                    'exportPDF', 'exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript',
                    'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed',
                    '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                    {
                        model: 'heading5',
                        view: 'h5',
                        title: 'Heading 5',
                        class: 'ck-heading_heading5'
                    },
                    {
                        model: 'heading6',
                        view: 'h6',
                        title: 'Heading 6',
                        class: 'ck-heading_heading6'
                    }
                ]
            },
            placeholder: 'Shipping Returns',
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            fontSize: {
                options: [10, 12, 14, 'default', 18, 20, 22],
                supportAllValues: true
            },
            htmlSupport: {
                allow: [{
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }]
            },
            htmlEmbed: {
                showPreviews: true
            },
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            mention: {
                feeds: [{
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
                        '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                        '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
                        '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }]
            },
            removePlugins: [
                'CKBox',
                'CKFinder',
                'EasyImage',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                'MathType',
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents'
            ]
        });
    </script>

    <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
@endsection
