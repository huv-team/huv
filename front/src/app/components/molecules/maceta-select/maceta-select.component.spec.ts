import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { MacetaSelectComponent } from './maceta-select.component';

describe('MacetaSelectComponent', () => {
  let component: MacetaSelectComponent;
  let fixture: ComponentFixture<MacetaSelectComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MacetaSelectComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(MacetaSelectComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
