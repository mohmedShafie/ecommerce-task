@extends('admin.layouts.app')

@section('title', trans('messages.Categories'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1>{{ trans('messages.Categories') }}</h1>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                            <i class="ti ti-plus"></i> {{ trans('messages.Create') }}
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ trans('messages.ID') }}</th>
                                    <th>{{ trans('messages.Image') }}</th>
                                    <th>{{ trans('messages.Name Ar') }}</th>
                                    <th>{{ trans('messages.Name En') }}</th>
                                    <th>{{ trans('messages.Description Ar') }}</th>
                                    <th>{{ trans('messages.Description En') }}</th>
                                    <th>{{ trans('messages.Section') }}</th>
                                    <th>{{ trans('messages.Parent') }}</th>
                                    <th>{{ trans('messages.Point') }}</th>
                                    <th>{{ trans('messages.Status') }}</th>
                                    <th>{{ trans('messages.Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>
                                            @if($category->image)
                                                <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $category->name_ar }}</td>
                                        <td>{{ $category->name_en }}</td>
                                        <td>{{ $category->description_ar }}</td>
                                        <td>{{ $category->description_en }}</td>
                                        <td>{{ $category->section ? $category->section->{'name_' . app()->getLocale()} : '-' }}</td>
                                        <td>{{ $category->parent ? $category->parent->{'name_' . app()->getLocale()} : '-' }}</td>
                                        <td>{{ $category->point }}</td>
                                        <td>
                                            <button class="btn btn-sm {{ $category->status ? 'btn-success' : 'btn-secondary' }}"
                                                onclick="changeStatus({{ $category->id }})">
                                                @if ($category->status)
                                                    <i class="ti ti-check"></i>
                                                @else
                                                    <i class="ti ti-x"></i>
                                                @endif
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary me-1"
                                                onclick="editCategory({{ $category->id }})"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editCategoryModal">
                                                <i class="ti ti-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="deleteCategory({{ $category->id }})">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center">{{ trans('messages.No data found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Category Modal -->
    <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCategoryModalLabel">{{ trans('messages.Create Category') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createCategoryForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="create_name_ar" class="form-label">{{ trans('messages.Name Ar') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="create_name_ar" name="name_ar" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="create_name_en" class="form-label">{{ trans('messages.Name En') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="create_name_en" name="name_en" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="create_description_ar" class="form-label">{{ trans('messages.Description Ar') }}</label>
                                    <textarea class="form-control" id="create_description_ar" name="description_ar" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="create_description_en" class="form-label">{{ trans('messages.Description En') }}</label>
                                    <textarea class="form-control" id="create_description_en" name="description_en" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="create_section_id" class="form-label">{{ trans('messages.Section') }} <span class="text-danger">*</span></label>
                                    <select class="form-select" id="create_section_id" name="section_id">
                                        <option value="">{{ trans('messages.Select Section') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="create_parent_id" class="form-label">{{ trans('messages.Parent Category') }}</label>
                                    <select class="form-select" id="create_parent_id" name="parent_id">
                                        <option value="">{{ trans('messages.Select Parent Category') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="create_point" class="form-label">{{ trans('messages.Point') }}</label>
                                    <input type="number" class="form-control" id="create_point" name="point" min="0" step="0.01">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="create_image" class="form-label">{{ trans('messages.Image') }}</label>
                                    <input type="file" class="form-control" id="create_image" name="image" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('messages.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('messages.Create') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">{{ trans('messages.Edit Category') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editCategoryForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_category_id" name="category_id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_name_ar" class="form-label">{{ trans('messages.Name Ar') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_name_ar" name="name_ar" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_name_en" class="form-label">{{ trans('messages.Name En') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_name_en" name="name_en" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_description_ar" class="form-label">{{ trans('messages.Description Ar') }}</label>
                                    <textarea class="form-control" id="edit_description_ar" name="description_ar" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_description_en" class="form-label">{{ trans('messages.Description En') }}</label>
                                    <textarea class="form-control" id="edit_description_en" name="description_en" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="edit_section_id" class="form-label">{{ trans('messages.Section') }} <span class="text-danger">*</span></label>
                                    <select class="form-select" id="edit_section_id" name="section_id">
                                        <option value="">{{ trans('messages.Select Section') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="edit_parent_id" class="form-label">{{ trans('messages.Parent Category') }}</label>
                                    <select class="form-select" id="edit_parent_id" name="parent_id">
                                        <option value="">{{ trans('messages.Select Parent Category') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="edit_point" class="form-label">{{ trans('messages.Point') }}</label>
                                    <input type="number" class="form-control" id="edit_point" name="point" min="0" step="0.01">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_image" class="form-label">{{ trans('messages.Image') }}</label>
                                    <input type="file" class="form-control" id="edit_image" name="image" accept="image/*">
                                    <div id="current_image_preview" class="mt-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('messages.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('messages.Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
const currentLocale = '{{ app()->getLocale() }}';
$(document).ready(function() {
    // Load sections and categories when modals are opened
    $('#createCategoryModal').on('show.bs.modal', function() {
        loadCreateFormData();
    });

    // Create category form submission
    $('#createCategoryForm').on('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        $.ajax({
            url: '{{ route("admin.categories.store") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '{{ trans("messages.Success") }}',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        $('#createCategoryModal').modal('hide');
                        location.reload();
                    });
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON?.errors || {};
                let errorMessage = '';

                Object.keys(errors).forEach(function(key) {
                    errorMessage += errors[key][0] + '\n';
                });

                Swal.fire({
                    icon: 'error',
                    title: '{{ trans("messages.Error") }}',
                    text: errorMessage || xhr.responseJSON?.message || '{{ trans("messages.Something went wrong") }}'
                });
            }
        });
    });

    // Edit category form submission
    $('#editCategoryForm').on('submit', function(e) {
        e.preventDefault();

        const categoryId = $('#edit_category_id').val();
        const formData = new FormData(this);

        $.ajax({
            url: '{{ route("admin.categories.update", ":id") }}'.replace(':id', categoryId),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '{{ trans("messages.Success") }}',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        $('#editCategoryModal').modal('hide');
                        location.reload();
                    });
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON?.errors || {};
                let errorMessage = '';

                Object.keys(errors).forEach(function(key) {
                    errorMessage += errors[key][0] + '\n';
                });

                Swal.fire({
                    icon: 'error',
                    title: '{{ trans("messages.Error") }}',
                    text: errorMessage || xhr.responseJSON?.message || '{{ trans("messages.Something went wrong") }}'
                });
            }
        });
    });
});

// Load form data for create modal
function loadCreateFormData() {
    $.ajax({
        url: '{{ route("admin.categories.create") }}',
        type: 'GET',
        success: function(response) {
            // Populate sections
            const sectionSelect = $('#create_section_id');
            sectionSelect.empty().append('<option value="">{{ trans("messages.Select Section") }}</option>');
            response.sections.forEach(function(section) {
                sectionSelect.append(`<option value="${section.id}">${section['name_' + currentLocale]}</option>`);
            });

            // Populate parent categories
            const parentSelect = $('#create_parent_id');
            parentSelect.empty().append('<option value="">{{ trans("messages.Select Parent Category") }}</option>');
            response.parentCategories.forEach(function(category) {
                parentSelect.append(`<option value="${category.id}">${category['name_' + currentLocale]}</option>`);
            });
        },
        error: function(xhr) {
            console.error('Error loading form data:', xhr);
        }
    });
}

// Edit category function
function editCategory(categoryId) {
    $.ajax({
        url: '{{ route("admin.categories.edit", ":id") }}'.replace(':id', categoryId),
        type: 'GET',
        success: function(response) {
            const category = response.category;

            // Fill form fields
            $('#edit_category_id').val(category.id);
            $('#edit_name_ar').val(category.name_ar);
            $('#edit_name_en').val(category.name_en);
            $('#edit_description_ar').val(category.description_ar);
            $('#edit_description_en').val(category.description_en);
            $('#edit_point').val(category.point);
            $('#edit_status').prop('checked', category.status == 1);

            // Populate sections
            const sectionSelect = $('#edit_section_id');
            sectionSelect.empty().append('<option value="">{{ trans("messages.Select Section") }}</option>');
            response.sections.forEach(function(section) {
                const selected = section.id == category.section_id ? 'selected' : '';
                sectionSelect.append(`<option value="${section.id}" ${selected}>${section['name_' + currentLocale]}</option>`);
            });

            // Populate parent categories
            const parentSelect = $('#edit_parent_id');
            parentSelect.empty().append('<option value="">{{ trans("messages.Select Parent Category") }}</option>');
            response.parentCategories.forEach(function(parentCategory) {
                const selected = parentCategory.id == category.parent_id ? 'selected' : '';
                parentSelect.append(`<option value="${parentCategory.id}" ${selected}>${parentCategory['name_' + currentLocale]}</option>`);
            });

            // Show current image if exists
            const imagePreview = $('#current_image_preview');
            if (category.image) {
                imagePreview.html(`
                    <div class="mt-2">
                        <small class="text-muted">{{ trans("messages.Current Image") }}:</small><br>
                        <img src="{{ asset('storage/') }}/${category.image}" alt="Current Image" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                    </div>
                `);
            } else {
                imagePreview.empty();
            }
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: '{{ trans("messages.Error") }}',
                text: '{{ trans("messages.Category not found") }}'
            });
        }
    });
}

// Delete category function
function deleteCategory(categoryId) {
    Swal.fire({
        title: '{{ trans("messages.Are you sure?") }}',
        text: '{{ trans("messages.You will not be able to recover this category") }}',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '{{ trans("messages.Yes, delete it") }}',
        cancelButtonText: '{{ trans("messages.Cancel") }}'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("admin.categories.destroy", ":id") }}'.replace(':id', categoryId),
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '{{ trans("messages.Deleted") }}',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: '{{ trans("messages.Error") }}',
                        text: xhr.responseJSON?.message || '{{ trans("messages.Cannot delete this category") }}'
                    });
                }
            });
        }
    });
}

// Change status function
function changeStatus(categoryId) {
    $.ajax({
        url: '{{ route("admin.categories.changeStatus", ":id") }}'.replace(':id', categoryId),
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                toastr.success(response.message);
                location.reload();
            }
        },
        error: function(xhr) {
            toastr.error(xhr.responseJSON?.message || '{{ trans("messages.Something went wrong") }}');
        }
    });
}
</script>
@endpush
