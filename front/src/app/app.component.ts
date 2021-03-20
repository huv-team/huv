import { Component } from '@angular/core';

import { AppRouteChangeService } from "src/app/services/app-route-change.service";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  
  title = 'front';

  constructor (
    private routeSrv:AppRouteChangeService
  ) {}
}
