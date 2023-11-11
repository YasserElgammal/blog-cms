<footer class="w-full border-t bg-white pb-12">
  <div class="w-full container mx-auto flex flex-col items-center">
      <div class="flex flex-col md:flex-row text-center md:text-left md:justify-between py-6">
          @foreach ($pages_footer as $page)
              <a href="{{ route('page.show', $page->slug) }}"
                  class="uppercase px-3 hover:text-blue-700">{{ $page->name }}</a>
          @endforeach
      </div>
      <div class="uppercase pb-6">&copy; {{ $setting->copy_rights }}</div>
  </div>
</footer>