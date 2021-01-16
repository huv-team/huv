import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { FrutoComponent } from './fruto.component';

describe('FrutoComponent', () => {
  let component: FrutoComponent;
  let fixture: ComponentFixture<FrutoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ FrutoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(FrutoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
