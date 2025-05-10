  {{-- <!-- Marquee -->
  <div id="marquee" class="marquee">


    <div class="marquee-content">
        <span class="marquee-item">🏠 Smart Home Upgrade</span>
        
        <span class="marquee-item">📱 Remote Home Control</span>
        
        <span class="marquee-item">📞 1-800-SMART-HOME</span>
        <span class="marquee-item">Update Your life Style</span>
    </div>
</div> --}}


<div id="marquee" class="marquee">
  <div class="marquee-content">
      @foreach($marquees as $item)
          <span class="marquee-item">{!! $item->content !!}</span>
      @endforeach
  </div>
</div>