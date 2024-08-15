<div class="card">
    @if (session()->has('message'))
        @php
            $message = session('message');
        @endphp
        <span class="alert alert-{{ $message['type'] }} p-2 my-2">{{ $message['text'] }}</span>
    @endif
      <div class="card-body">
        <h1 class="card-title"> My Blogs</h1>
        <div class="row">
            <div class="col">
                <div class="card" style="background-color: #38434b; font-size:20px;">
                  <div class="card-body text-center text-white mt-3">
                      Followers
                  </div>
                  <div class="card-footer text-center text-white"  style="background-color: #38434b">
                    {{$followers_count}}
                  </div>
                </div>
            </div>

            <div class="col">
                <div class="card" style="background-color: #38434b; font-size:20px;">
                  <div class="card-body text-center text-white mt-3">
                      Likes
                  </div>
                  <div class="card-footer text-center text-white"  style="background-color: #38434b">
                    {{$likes_count}}
                  </div>
                </div>
            </div>

            <div class="col">
                <div class="card" style="background-color: #38434b; font-size:20px;">
                  <div class="card-body text-center text-white mt-3">
                      Comments
                  </div>
                  <div class="card-footer text-center text-white"  style="background-color: #38434b">
                    {{$comments_count}}
                  </div>
                </div>
            </div>
            <div class="col" >
                <div class="card" style="background-color: #38434b; font-size:20px;">
                  <div class="card-body text-center text-white mt-3">
                      Posts
                  </div>
                  <div class="card-footer text-center text-white"  style="background-color: #38434b">
                    {{$posts->count()}}
                  </div>
                </div>
            </div>
          </div>

        <!-- Table with stripped rows -->
        <table class="table datatable">
          <thead>
            <tr>
              <th scope="col">id</th>
              <th scope="col">Image</th>
              <th scope="col">Title</th>
              <th scope="col">Content</th>
              <th scope="col">Date</th>
              <th scope="col">Last updated</th>
              <th scope="col" colspan="2">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $item)
            {{-- for livewire to keep track and work efficient with loops use keys to uniquely identify each row in a loop --}}
                <tr wire:key="{{$item->id}}">
                  <th scope="row">{{$loop->iteration}}</th>
                  <td><img height="40px" width="40px" src="{{ asset('storage/images/' .$item->photo) }}" alt="image"></td>
                  <td>{{$item->post_title}}</td>
                  <td>{{str($item->content)->words(10)}}</td>
                  <td>{{$item->created_at}}</td>
                  <td>{{$item->updated_at}}</td>
                  <td><a href="/edit/post/{{$item->id}}" wire:navigate class="btn btn-primary btn-sm">Edit</a></td>
                  <td><button wire:click="deletePost({{$item->id}})" class="btn btn-danger btn-sm">Delete</button></td>
                </tr>
            @endforeach
          </tbody>
        </table>
        <!-- End Table with stripped rows -->
      </div>
    </div>
