<?php

class horloge_view {
    use view;
    public function before_render() {
        $this->set_vars([
            'date' => date('d/m/Y'),
            'heure' => date('H:i'),
        ]);
    }
}