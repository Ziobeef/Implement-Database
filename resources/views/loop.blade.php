@foreach($bukus as $buku)
   {{$buku->judul}} 
   {{$buku->id}}
@endforeach
<br>
@foreach($genres as $genre)
    {{$genre->name}}
    {{$genre->id}}
@endforeach
<br>
@foreach($toys as $toy)
    {{$toy->name}}
    {{$toy->brand_id}}
    {{$toy->brand->name}}

@endforeach
<br>
@foreach($categories as $category)
 {{$category->name}}
 {{$category->id}}
 @foreach($category->stores as $store)
 {{$store->name}}
 @endforeach
@endforeach
<br>
@foreach($countries as $country)
{{$country-> name}}
@foreach($country->coins as $coin)
{{$coin->name}}
@endforeach
@endforeach










