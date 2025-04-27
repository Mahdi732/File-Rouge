@foreach ($categories as $categorie)
<button 
type="button" 
@click="addCategory('{{$categorie->name}}')" 
:class="{'bg-orange-100 text-orange-800 border-orange-300': isCategorySelected('{{$categorie->name}}')}"
class="category-pill px-3 py-1 rounded-full text-sm font-medium border border-gray-200 hover:border-orange-300"
>
    {{$categorie->name}}
</button>
@endforeach