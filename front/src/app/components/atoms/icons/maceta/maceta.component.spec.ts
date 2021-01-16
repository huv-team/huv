import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { MacetaComponent } from './maceta.component';

describe('MacetaComponent', () => {
  let component: MacetaComponent;
  let fixture: ComponentFixture<MacetaComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MacetaComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(MacetaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
