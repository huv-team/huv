import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-calendar-tiles',
  templateUrl: './calendar-tiles.component.html',
  styleUrls: ['./calendar-tiles.component.scss']
})
export class CalendarTilesComponent implements OnInit {

  @Input() title:string;
  @Input() selected:number[];
  
  meses:string[] = ['ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC'];
  
  constructor() { }

  ngOnInit(): void {
  }

  isSelected(idx:number){
    return this.selected.findIndex( el => el === idx+1) > -1;
  }

}
