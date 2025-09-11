 @props(['title' => 'Title', 'number' => 0])
 <div class="p-8 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
     <h3 class="text-4xl font-bold text-primary mb-2">
         <span class="stats-number" data-target="5">
             {{ $number }}
         </span>+
     </h3>
     <p class="text-gray-600">
         {{ $title }}
     </p>
 </div>