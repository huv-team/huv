import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CalendarTilesComponent } from './calendar-tiles.component';

describe('CalendarTilesComponent', () => {
  let component: CalendarTilesComponent;
  let fixture: ComponentFixture<CalendarTilesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CalendarTilesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CalendarTilesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
