<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/vercel", function () {
    return \Illuminate\Support\Facades\Blade::render(<<<'BLADE'
        <x:layout>
            <div class="space-y-4">
                <div class="m-4 bg-indigo-100 text-indigo-900 p-4 rounded-b-lg border-t-4 border-indigo-500 flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                       <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                       <path d="M12 9h.01"></path>
                       <path d="M11 12h1v4h1"></path>
                    </svg>

                    <p>Hello, world!</p>
                </div>

                <div class="m-4 bg-red-100 text-red-900 p-4 rounded-b-lg border-t-4 border-red-500 flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                       <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                       <path d="M12 9v4"></path>
                       <path d="M12 16v.01"></path>
                    </svg>

                    <p>Hello, world!</p>
                </div>
            </div>

            <div class="m-4 space-y-2">
                <h1 class="text-2xl text-gray-900 font-semibold">Hello, world!</h1>

                <p class="text-gray-800 leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur elementum risus sed bibendum suscipit. Duis rhoncus eget nunc vitae ultrices. In at felis est. Maecenas ac congue arcu. Fusce scelerisque id mi ut tristique. Sed vel tortor a purus dignissim porta vitae quis velit. Ut ut elit non purus lobortis molestie. Sed rutrum lacinia augue eget tempor. Aliquam magna sem, consequat ut mi id, laoreet dapibus tortor. Ut id efficitur elit, quis accumsan leo. Ut eu accumsan risus, sed fermentum arcu. Quisque sit amet quam at dolor imperdiet pulvinar. Nam accumsan pharetra luctus. Donec ut tortor ligula. Duis nec sem nec est faucibus ullamcorper. Nam felis est, commodo vitae interdum eget, ultrices gravida turpis. Donec non tincidunt eros. Donec vestibulum ex eget accumsan viverra. Quisque feugiat dui ac feugiat pretium. Donec bibendum tortor urna, ac aliquam velit pellentesque ac. Proin nec orci at lectus efficitur consequat sit amet viverra justo. In ultrices et felis quis aliquam. Mauris ut metus eget lectus vestibulum laoreet. Integer interdum venenatis nulla non ultricies. Donec facilisis turpis ac dapibus dapibus. In sagittis odio ut ante lacinia, vel vehicula leo fringilla. Nam justo velit, vulputate ut placerat sed, porta ut enim. Nam mollis leo non lectus tempus, non lobortis augue mollis. Phasellus sit amet volutpat risus, in hendrerit libero. Sed auctor metus purus, hendrerit ornare erat vehicula id. Donec pellentesque malesuada ante, in ultricies neque. Sed tellus quam, aliquam in mollis imperdiet, facilisis a felis. Suspendisse luctus, urna suscipit porta sollicitudin, leo nunc eleifend purus, quis molestie purus odio ut turpis. Maecenas sed blandit nisl. Nunc vestibulum, risus non luctus viverra, erat augue faucibus neque, feugiat volutpat magna velit ut ipsum. Fusce tristique mattis imperdiet. Aliquam nec mauris quis est lacinia rutrum nec at libero. Cras facilisis maximus elementum. Nam orci dolor, semper sed feugiat nec, sodales quis sem. Nulla vitae tortor turpis. Donec bibendum felis eu bibendum ultricies. Curabitur id nisi mi. Maecenas augue ligula, consectetur ut rhoncus ut, congue eu urna. Integer a egestas arcu. Nam venenatis, lacus nec luctus molestie, felis sem eleifend quam, non consequat tellus sem in nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Proin pellentesque vel ipsum et varius. Sed vehicula, leo a ultricies malesuada, ante erat semper diam, sit amet imperdiet metus tellus at turpis. Etiam porta vehicula egestas. Sed gravida, nulla in ullamcorper aliquam, nunc erat lacinia nibh, at pulvinar eros sapien ac lectus. Ut at lorem ut sapien vulputate malesuada. Aliquam iaculis tincidunt nibh, sit amet aliquet dui molestie in. Etiam venenatis ex vel velit aliquet, vel sagittis tellus efficitur. Nunc eget facilisis ligula. Morbi posuere pharetra dolor, sed convallis ipsum tempor id. Ut eleifend, neque in pellentesque tincidunt, lorem eros accumsan diam, sodales luctus nisl orci quis sapien. Aenean nisi dolor, maximus placerat erat eget, consequat vulputate felis. Phasellus iaculis tincidunt lorem, vitae condimentum augue laoreet at. Suspendisse maximus urna sed sem imperdiet vulputate. Praesent feugiat ante quis sem rutrum, gravida facilisis tortor rhoncus. Mauris gravida auctor varius. Mauris eget felis nisi. Curabitur nec justo ipsum. Aenean sed accumsan dolor, at luctus nisl. Vivamus varius enim id augue posuere, a posuere orci tristique. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum vulputate varius placerat. Praesent et quam dui. Aenean sed nibh at augue euismod pellentesque. Cras finibus euismod semper. Suspendisse gravida purus nec tortor placerat sodales. Ut quis mollis justo. Proin consectetur augue ut eros scelerisque tincidunt. Etiam nec volutpat risus. Mauris interdum vulputate est ac efficitur. Donec luctus, felis nec porttitor volutpat, mauris justo rutrum nibh, sit amet viverra mauris magna ut dolor. Curabitur hendrerit fermentum luctus. Mauris vel ornare est. Sed placerat, ipsum quis rutrum pharetra, lorem magna vehicula sem, vitae placerat augue odio eu justo. Duis interdum erat augue, eget elementum dolor semper vel. Etiam bibendum ante at ornare feugiat. Cras dictum nulla eros, at aliquam nunc accumsan et. Nunc in neque lacus. Ut eget pulvinar mauris. Maecenas a lacinia urna. Aenean consequat pharetra justo eget molestie. Sed sit amet libero ac nibh malesuada imperdiet. Nunc dignissim lacinia sem ut facilisis. Maecenas ut diam et lectus porta elementum at ac lacus. Aenean placerat enim sed dui venenatis, sed vehicula sapien facilisis. Maecenas tortor augue, mollis non arcu nec, luctus euismod arcu. Nulla sapien mi, consectetur id ligula eget, tristique rhoncus quam. Vivamus arcu risus, commodo et euismod ut, lobortis eu lacus. Curabitur in faucibus magna. Aliquam vehicula mi eget lacinia pulvinar. Aliquam accumsan gravida justo, nec auctor tortor condimentum nec. Proin sit amet arcu bibendum, pharetra enim ut, commodo massa. Cras erat diam, ultrices quis enim eu, vulputate hendrerit enim. Etiam sit amet nibh sapien. Suspendisse potenti. Aenean blandit tincidunt ultrices. Suspendisse at euismod erat, at convallis odio. Nulla facilisis magna quis bibendum convallis. Phasellus iaculis porta felis, sit amet fringilla est sollicitudin ultricies. Vestibulum tristique suscipit tincidunt. Nullam scelerisque id dolor vitae laoreet. Quisque eu ipsum urna. Maecenas quis posuere magna. Quisque mollis mi vel lectus mattis mattis. Praesent aliquet, nulla nec mollis dapibus, ex risus ultricies velit, vel hendrerit massa justo eget lectus. Nullam massa justo, luctus et metus vel, blandit sollicitudin ex. Maecenas non feugiat eros, quis aliquet eros. In vitae ligula felis. Pellentesque aliquet libero vel finibus mattis. Duis rhoncus vehicula nisi ac rhoncus. Duis sit amet sapien posuere, lobortis nunc vel, tempor elit. Praesent commodo interdum mi, vitae laoreet sem finibus non. Ut at libero id purus accumsan lobortis. Sed aliquet sit amet lorem a imperdiet. Sed pharetra sapien in leo bibendum suscipit. Etiam auctor vitae lacus consectetur facilisis. Nunc varius ex sed fringilla efficitur. Nulla ligula augue, sodales vitae sodales ut, pellentesque sed diam. Vivamus non viverra nibh, eget commodo libero. Sed ac sapien pellentesque, auctor turpis id, rutrum eros. Cras tempor vel nisl ac feugiat. In pulvinar consequat arcu, vitae fringilla ante cursus ac. Fusce posuere interdum dictum. Ut malesuada magna ac placerat porttitor. Aliquam interdum erat nisl. Fusce eget placerat dui. Maecenas quis mauris quis ligula tempus ultricies. Vivamus luctus leo vel dui molestie, sit amet vulputate augue iaculis. Aliquam pharetra imperdiet urna, et luctus libero sollicitudin mattis. Duis mauris nisl, hendrerit eget vestibulum sit amet, porttitor ac tortor. Curabitur tempus sodales pulvinar. Maecenas vestibulum, nisl non sagittis blandit, justo nisi pellentesque orci, in laoreet enim felis nec dui. In at libero orci. Donec commodo nulla ac urna luctus porta eu sed purus. Duis egestas nisi sed odio posuere, nec malesuada enim congue. Duis eu tristique augue, nec posuere augue. Quisque sodales ultrices risus, sit amet hendrerit arcu tempor nec. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Curabitur cursus augue ut gravida lacinia. Suspendisse eget efficitur lacus. Morbi ultrices maximus neque, quis aliquet eros pretium quis. Nulla suscipit blandit nulla vitae tempor. Etiam ligula purus, interdum eget sapien sit amet, gravida luctus velit. Sed sapien turpis, feugiat ac sollicitudin a, blandit interdum ligula. Donec ullamcorper blandit arcu, id tincidunt nulla suscipit in. Cras commodo mauris vitae ante tempor, ac iaculis sapien tincidunt. Morbi eu quam nec quam porttitor viverra. Vestibulum iaculis sem ligula, nec varius sapien tempus id. Cras porta bibendum mi, vitae aliquet dolor. Phasellus magna felis, pretium id gravida vulputate, condimentum in ipsum. Fusce scelerisque hendrerit scelerisque. Proin ac euismod est. Phasellus blandit metus et arcu consequat sollicitudin. Donec venenatis urna laoreet tincidunt bibendum. Integer lorem dolor, lacinia eu rhoncus et, laoreet non dolor. Fusce placerat sit amet mauris non convallis. Nullam sed augue blandit mauris dapibus congue. Donec nec lorem nisl.
                </p>
            </div>
        </x:layout>
    BLADE);
});
