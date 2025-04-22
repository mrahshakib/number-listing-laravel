<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Number Listing System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container mx-auto bg-light mt-5 p-4 rounded">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center mb-2">
                    <h2>Phone Number Listing System</h2>
                    <a href="{{route('index')}}"><button class="btn btn-dark mt-3">Home</button></a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('index.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control form-control-lg"
                                            placeholder="Enter Name Here" value="AGENT {{old('name', $data->total() + 1)}}">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="text" name="number" id="number"
                                            class="form-control form-control-lg" placeholder="Enter Number Here"
                                            value="{{old('number')}}" oninput="convert(this)">
                                        @error('number')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group d-flex justify-content-center">
                                        <button class="btn btn-success btn-lg">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">List of Number</div>
                    <div class="card-body">
                        <table class="table align-middle table-bordered table-hover caption-top">
                            <thead class="table-success">
                                <caption>Showing {{ $data->count() }} of {{ $data->total() }} numbers.</caption>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Number</th>
                                    <th>Created</th>
                                    <th>Modified</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($data->count() > 0)
                                    @foreach ($data as $item)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>+88{{ $item->number }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->updated_at }}</td>
                                            <td>
                                                <button class="btn btn-primary"
                                                    onclick="confirmEdit('{{route('edit', $item->id)}}')">Edit</button>
                                                <button class="btn btn-danger"
                                                    onclick="confirmDelete('{{route('delete', $item->id)}}')">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <td colspan="6">No number saved yet.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="mt-4 d-flex justify-content-center">
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script>

        function confirmEdit(url) {
            Swal.fire({
                title: "Are you sure want to edit?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, edit it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Optional: Show success alert before redirecting
                    window.location.href = url;
                }
            });
        }


        function confirmDelete(url) {
            Swal.fire({
                title: "Are you sure delete?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Optional: Show success alert before redirecting
                    Swal.fire({
                        title: "Deleted!",
                        text: "Number has been deleted.",
                        icon: "success",
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = url;
                    });
                }
            });
        }
        
        
        
        // Convert Bangla to English and keep only numbers
            function convert(input) {
                const banglaDigits = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
                const englishDigits = ['0','1','2','3','4','5','6','7','8','9'];
            
                let trimmed = input.value.trim(); // Trim whitespace from both ends
            
                let converted = trimmed.split('').map(char => {
                    let index = banglaDigits.indexOf(char);
                    return index !== -1 ? englishDigits[index] : char;
                }).join('');
            
                // Remove any non-numeric characters
                converted = converted.replace(/[^0-9]/g, '');
            
                input.value = converted;
            }


    </script>
</body>

</html>
