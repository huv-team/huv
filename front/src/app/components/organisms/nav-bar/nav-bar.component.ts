import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

import { SitePage } from "src/app/redux/site/site.model";

@Component({
  selector: 'app-nav-bar',
  templateUrl: './nav-bar.component.html',
  styleUrls: ['./nav-bar.component.scss']
})
export class NavBarComponent implements OnInit {
  
  pages = SitePage;

  constructor(
    private router: Router,
  ) { }

  ngOnInit(): void {
  }

  navigate2(url:string) {
    this.router.navigate([url]);
  }

}
