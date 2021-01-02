import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { EpocasCalendarComponent } from './epocas-calendar.component';

describe('EpocasCalendarComponent', () => {
  let component: EpocasCalendarComponent;
  let fixture: ComponentFixture<EpocasCalendarComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ EpocasCalendarComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(EpocasCalendarComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
