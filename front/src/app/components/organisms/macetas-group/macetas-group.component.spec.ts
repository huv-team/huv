import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { MacetasGroupComponent } from './macetas-group.component';

describe('MacetasGroupComponent', () => {
  let component: MacetasGroupComponent;
  let fixture: ComponentFixture<MacetasGroupComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MacetasGroupComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(MacetasGroupComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
