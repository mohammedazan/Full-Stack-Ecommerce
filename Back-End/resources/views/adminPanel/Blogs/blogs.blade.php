@extends('adminPanel.layout.layout')

@section('main_content')
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBlogModal">
                            <i class="lni lni-circle-plus"></i> Ajouter un Blog
                        </button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Propriétaire du Blog</th>
                            <th>Titre Court</th>
                            <th>Titre</th>
                            <th>Contenu</th>
                            <th>Logo</th>
                            <th>Slug</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blogs as $blog)
                        <tr>
                            <td>{{ $blog->id }}</td>
                            <td>{{ $blog->blogowner }}</td>
                            <td>{{ $blog->Shorttitle }}</td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->content }}</td>
                            <td>
                                <img src="{{ asset('uploads_blogs/blogs/' . $blog->img) }}" alt="Image du Post" style="width: 70px; height: auto;">
                            </td>
                            <td>{{ $blog->slug }}</td>
                            <td>{{ $blog->created_at }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">Action</button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#" onclick="editBlog({{ json_encode($blog) }})">Modifier</a></li>
                                        <li><a class="dropdown-item" href="/admin/blogs/{{$blog->id}}/delete" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    

<!-- Modal de Création de Blog -->
<div class="modal fade" id="createBlogModal" tabindex="-1" aria-labelledby="createBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/admin/blogs/store" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createBlogModalLabel">Créer un Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="content" class="form-label">Contenu</label>
                        <textarea name="content" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Propriétaire du Blog</label>
                        <input type="text" name="blogowner" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="img" class="form-label">Image</label>
                        <input type="file" name="img" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="remarque" class="form-label">Titre Court</label>
                        <input type="text" name="Shorttitle" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>


   <!-- Edit Blog Modal -->
<!-- Edit Blog Modal -->
<div class="modal fade" id="editBlogModal" tabindex="-1" aria-labelledby="editBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editBlogForm" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBlogModalLabel">Modifier le Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_content" class="form-label">Contenu</label>
                        <textarea name="content" class="form-control" id="edit_content" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_blogowner" class="form-label">Propriétaire du Blog</label>
                        <input id="edit_blogowner" type="text" name="blogowner" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_title" class="form-label">Titre</label>
                        <input type="text" name="title" class="form-control" id="edit_title" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_img" class="form-label">Image</label>
                        <input type="file" name="img" class="form-control" id="edit_img">
                    </div>
                    <div class="mb-3">
                        <label for="edit_Shorttitle" class="form-label">Titre Court</label>
                        <input id="edit_Shorttitle" type="text" name="Shorttitle" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_slug" class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" id="edit_slug" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>



</div>

<script>
function editBlog(blog) {
    $('#editBlogForm').attr('action', '/admin/blogs/' + blog.id + '/update');
    $('#edit_content').val(blog.content);
    $('#edit_blogowner').val(blog.blogowner);
    $('#edit_title').val(blog.title);
    $('#edit_Shorttitle').val(blog.Shorttitle);
    $('#edit_slug').val(blog.slug);
    $('#editBlogModal').modal('show');
}
</script>

@endsection
