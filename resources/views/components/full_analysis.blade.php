@inject('helpers', 'App\Services\BladeHelpersService')

<section class="section">
  <div class="container">
    <div class="tabs">
      <ul role="tablist">
        <li role="presentation" class="is-active">
          <a href="#general" aria-controls="general" role="tab">General</a>
        </li>
        <li role="presentation">
          <a href="#advancing" aria-controls="advancing" role="tab">Advancing</a>
        </li>
        <li role="presentation">
          <a href="#chat" aria-controls="chat" role="tab">Chat</a>
        </li>
        <li role="presentation">
          <a href="#researches" aria-controls="researches" role="tab">Researches</a>
        </li>
      </ul>
    </div>
    <div class="tab-panel is-active" id="general" role="tabpanel">
      <h2 class="tab-title">General</h2>
      <div class="columns">
        <div class="column" style="order: 2">
          <img src="{{ asset($mapPath) }}" alt="Minimap">
        </div>
        <div class="column" style="order: 1">
          <dl>
            <dt>Version</dt>
            <dd>{{ $rec->version()->name }}</dd>

            <dt>Duration</dt>
            <dd>{{ $helpers->formatGameTime($rec->body()->duration) }}</dd>

            <dt>Type</dt>
            <dd>{{ $rec->gameSettings()->gameType }}</dd>

            <dt>Map</dt>
            <dd>{{ $rec->gameSettings()->mapName() }}</dd>

            <dt>PoV</dt>
            <dd>{{ $pov ? $pov->name : 'Unknown' }}</dd>
          </dl>
        </div>
      </div>

      <div class="columns is-multiline">
        @foreach ($rec->teams() as $team)
          <div class="column is-half-tablet is-quarter-desktop">
            <header>
              <h4>Team {{ $team->index }}</h4>
            </header>
            @foreach ($team->players() as $player)
              <div class="media">
                <figure class="media-left">
                  <p class="image">
                    <img src="{{ $helpers->getCivImage($player->colorId, $player->civId) }}"
                          alt="{{ $player->civName() }}">
                  </p>
                </figure>
                <div class="media-content">
                  <strong class="title" style="color: {{ $player->color() }}">
                    {{ $player->name }}
                  </strong>
                  <p>{{ $player->civName() }}</p>
                </div>
              </div>
            @endforeach
          </div>
        @endforeach
      </div>
    </div>
    <div class="tab-panel" id="advancing" role="tabpanel">
      <h2 class="tab-title">Advancing</h2>
      <div class="columns is-multiline">
        @foreach ($rec->teams() as $team)
          <div class="column is-half-tablet">
            <header>
              <h4>Team {{ $team->index }}</h4>
            </header>
            @foreach ($team->players() as $player)
              <div class="media">
                <figure class="media-left">
                  <p class="image">
                    <img src="{{ $helpers->getCivImage($player->colorId, $player->civId) }}"
                          alt="{{ $player->civName() }}">
                  </p>
                </figure>
                <div class="media-content">
                  <p>
                    <span class="title">
                      {{ $player->name }} ({{ $player->civName() }})
                    </span> <br>
                    <figure class="image is-16x16">
                      <img src="{{ asset('../recanalyst/resources/researches/feudal_age.png') }}" alt="">
                    </figure>
                    Feudal: {{ $helpers->formatGameTime($player->getFeudalTime()) }} <br>
                    <figure class="image is-16x16">
                      <img src="{{ asset('../recanalyst/resources/researches/castle_age.png') }}" alt="">
                    </figure>
                    Castle: {{ $helpers->formatGameTime($player->getCastleTime()) }} <br>
                    <figure class="image is-16x16">
                      <img src="{{ asset('../recanalyst/resources/researches/imperial_age.png') }}" alt="">
                    </figure>
                    Imperial: {{ $helpers->formatGameTime($player->getImperialTime()) }}
                  </p>
                </div>
              </div>
            @endforeach
          </div>
        @endforeach
      </div>
    </div>
    <div class="tab-panel" id="chat" role="tabpanel">
      <h2 class="tab-title">Chat</h2>
      <h3>Pre-game</h3>
      @foreach ($rec->header()->pregameChat as $message)
        <div class="ChatMessage">
          <span class="ChatMessage-sender">{{ $message->player->name }}</span>:
          {{ $message->msg }}
        </div>
      @endforeach
      <div class="Chat-ingame">
        <h3>In-game</h3>
        @foreach ($rec->body()->chatMessages as $message)
          <div class="ChatMessage">
            <span class="ChatMessage-time">
              {{ $helpers->formatGameTime($message->time) }}
            </span>
            @if ($message->player)
              <span class="ChatMessage-sender" style="color: {{ $message->player->color() }}">
                {{ $message->player->name }}
              </span>:
              {{ $message->msg }}
            @else
              <em>{{ $message->msg }}</em>
            @endif
          </div>
        @endforeach
      </div>
    </div>
    <div class="tab-panel" id="researches" role="tabpanel">
      <h2 class="tab-title">Researches</h2>
      @foreach ($rec->players() as $player)
        <div class="row valign-wrapper">
          <div class="col s3 m2 l1">
            <img src="{{ $helpers->getCivImage($player->colorId, $player->civId) }}"
                  alt="{{ $player->civName() }}"
                  class="circle">
            <p class="title">
              <strong>{{ $player->name }}</strong> <br>
              {{ $player->civName() }}
            </p>
          </div>
          <div class="col s9 m10 l11">
            @foreach ($player->researches() as $research)
              <div class="center-align left">
                <div class="grey-text text-darken-3">
                  {{ $helpers->formatGameTime($research->time) }}
                </div>
                <img src="{{ $helpers->getResearchImage($research) }}">
                <div>{{ $helpers->getResearchName($research) }}</div>
              </div>
            @endforeach
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>