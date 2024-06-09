@extends('adminPanel.layout.layout')

@section('main_content')
<div class="page-content">
    <div class="card">
        <div class="card-body">
           
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Rate</th>
                            <th>Content</th>
                            <th>Name User </th>
                            <th>Product_review_details</th>
                            <th>Name Product</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($review as $r)
                        <tr>
                            <td>{{ $r->id }}</td>
                            <td>{{ $r->rate }}</td>
                            <td>{{ $r->content}}</td>
                            <td>{{ $r->user->name}}</td>
                            <td>{{ $r->product_id}}</td>
                            <td>{{ $r->product->name}}</td>
                            <td>{{ $r->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
