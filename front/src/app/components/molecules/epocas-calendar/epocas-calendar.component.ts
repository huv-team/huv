import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-epocas-calendar',
  templateUrl: './epocas-calendar.component.html',
  styleUrls: ['./epocas-calendar.component.scss']
})
export class EpocasCalendarComponent implements OnInit {

  meses:string[] = ['ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC'];
  
  constructor() { }

  ngOnInit(): void {
  }

}
