import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-calendar-tiles',
  templateUrl: './calendar-tiles.component.html',
  styleUrls: ['./calendar-tiles.component.scss']
})
export class CalendarTilesComponent implements OnInit {

  @Input() tipo:string;
  
  constructor() { }

  ngOnInit(): void {
  }

}
